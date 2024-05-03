<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Models\Scholarship;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SpecialScholarshipDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ScholarshipData::with('scholarship.donor')->whereNotNull('start_scholarship')->whereNull('start_registration_at')->get();

        return view('admin.specscholarship.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Scholarship::with('donor')->get();

        $tahunSekarang = date('Y');
        $tahunArray = range($tahunSekarang, $tahunSekarang - 15);

        return view('admin.specscholarship.create')->with('data', $data)->with('tahunArray', $tahunArray);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'scholarships_id' => 'required|exists:scholarships,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'amount' => 'required|integer|min:0',
            'amount_period' => 'required|string|max:5',
            'duration' => 'required|integer|min:1',
            'start_scholarship' => 'required|date',
            'end_scholarship' => 'required|date|after_or_equal:start_scholarship',
            'student_list_file' => 'required|file|mimes:xlsx',
        ]);

        $scholarship = ScholarshipData::create($data);

        $import = new StudentsImport($scholarship->id);
        Excel::import($import, $request->file('student_list_file'));

        if ($import->hasUnlinkedNPM()) {
            $unlinkedNPMs = $import->unlinkedNPMs;
            UserScholarship::where('scholarship_data_id', $scholarship->id)->delete();
            ScholarshipData::findOrFail($scholarship->id)->delete();

            return redirect()->back()->with('error', 'Terdapat npm yang tidak terdata: ' . implode(', ', $unlinkedNPMs));
        }

        return redirect()->route('pengelolaan-khusus.index')->with('success', 'Berhasil menambahkan data beasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $scholarship = ScholarshipData::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $scholarship = ScholarshipData::findOrFail($id);
        }

        return view('admin.specscholarship.show')->with('beasiswa', $scholarship);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $scholarship = ScholarshipData::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $scholarship = ScholarshipData::findOrFail($id);
        }

        $data = Scholarship::with('donor')->get();

        $tahunSekarang = date('Y');
        $tahunArray = range($tahunSekarang, $tahunSekarang - 15);

        return view('admin.specscholarship.edit')->with('data', $data)
            ->with('tahunArray', $tahunArray)
            ->with('scholarship', $scholarship);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'scholarships_id' => 'required|exists:scholarships,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'amount' => 'required|integer|min:0',
            'amount_period' => 'required|string|max:5',
            'duration' => 'required|integer|min:1',
            'start_scholarship' => 'required|date',
            'end_scholarship' => 'required|date|after_or_equal:start_scholarship',
            'student_list_file' => 'nullable|file|mimes:xlsx',
        ]);

        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->update($data);

        if ($request->hasFile('student_list_file')) {
            $scholarshipId = $scholarship->id;
            UserScholarship::where('scholarship_data_id', $scholarshipId)->delete();

            $import = new StudentsImport($scholarshipId);
            Excel::import($import, $request->file('student_list_file'));

            if ($import->hasUnlinkedNPM()) {
                $unlinkedNPMs = $import->unlinkedNPMs;
                UserScholarship::where('scholarship_data_id', $scholarshipId)->delete();

                return redirect()->back()->with('error', 'Gagal mengupdate data beasiswa. Terdapat npm yang tidak terdata: ' . implode(', ', $unlinkedNPMs));
            }
        }

        return redirect()->route('pengelolaan-khusus.index')->with('success', 'Berhasil mengupdate data beasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->delete();

        return redirect()->route('pengelolaan-khusus.index')->with('success', 'Berhasil menghapus Data Beasiswa');
    }

    public function updateSK(Request $request, string $id)
    {
        $request->validate([
            'sk_number' => 'required|string|max:50',
            'sk_file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $scholarship = ScholarshipData::findOrFail($id);

        $scholarship->fill($request->only(['sk_number']));

        if ($request->hasFile('sk_file')) {
            if ($scholarship->sk_file) {
                Storage::delete($scholarship->sk_file);
            }

            $scholarshipName = $scholarship->scholarship->name;
            $sk_fileName = 'SK_' . $scholarshipName . '_' . $scholarship->year . '.pdf';

            $sk_filePath = $request->file('sk_file')->storeAs('sk_file', $sk_fileName, 'public');
            $scholarship->sk_file = $sk_filePath;
        }

        $scholarship->save();

        return redirect()->route('pengelolaan-khusus.index')->with('success', 'Berhasil mengupdate SK beasiswa');
    }
}
