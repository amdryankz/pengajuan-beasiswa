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
        $data = ScholarshipData::with('scholarship')->whereNotNull('start_scholarship')->whereNull('start_registration_at')->get();

        return view('admin.specscholarship.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Scholarship::all();

        $tahunSekarang = date('Y');
        $tahunArray = range($tahunSekarang, $tahunSekarang - 10);

        return view('admin.specscholarship.create')->with('data', $data)
            ->with('tahunArray', $tahunArray);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'scholarships_id' => 'required|exists:scholarships,id',
            'year' => 'required|integer',
            'amount' => 'required|string|max:255',
            'amount_period' => 'required|string|max:255',
            'duration' => 'required|integer',
            'start_scholarship' => 'required|date',
            'end_scholarship' => 'required|date|after_or_equal:start_scholarship',
            'student_list_file' => 'required|file|mimes:xlsx',
        ]);

        $scholarship = ScholarshipData::create($data);

        $import = new StudentsImport($scholarship->id);
        Excel::import($import, $request->file('student_list_file'));

        if ($import->hasUnlinkedNPM()) {
            UserScholarship::where('scholarship_data_id', $scholarship->id)->delete();
            ScholarshipData::findOrFail($scholarship->id)->delete();

            return redirect()->back()->with('error', 'Terdapat npm yang tidak terdata.');
        }

        $scholarship->update([
            'student_list_file' => $request->file('student_list_file')->store('student_list_file', 'public'),
        ]);

        return redirect()->route('pengelolaan-khusus.index')
            ->with('success', 'Berhasil menambahkan data beasiswa');
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

        return view('admin.specscholarship.show', ['beasiswa' => $scholarship]);
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

        $data = Scholarship::all();

        $tahunSekarang = date('Y');
        $tahunArray = range($tahunSekarang, $tahunSekarang - 10);

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
            'scholarships_id' => 'required|exists:donors,id',
            'year' => 'required|integer',
            'amount' => 'required|string|max:255',
            'amount_period' => 'required|string|max:255',
            'duration' => 'required|integer',
            'start_scholarship' => 'required|date',
            'end_scholarship' => 'required|date|after_or_equal:start_scholarship',
            'student_list_file' => 'file|mimes:xlsx',
        ]);

        try {
            $scholarship = ScholarshipData::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $scholarship = ScholarshipData::findOrFail($id);
        }

        $scholarship->update($data);

        if ($request->hasFile('student_list_file')) {
            Excel::import(new StudentsImport($scholarship->id), $request->file('student_list_file'));

            $scholarship->update([
                'student_list_file' => $request->file('student_list_file')->store('student_list_file', 'public'),
            ]);
        }

        return redirect()->route('pengelolaan-khusus.index')
            ->with('success', 'Berhasil mengupdate data beasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->delete();

        return redirect()->route('pengelolaan-khusus.index');
    }

    public function updateSK(Request $request, string $id)
    {
        $request->validate([
            'sk_number' => 'nullable|string|max:255',
            'sk_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $scholarship = ScholarshipData::findOrFail($id);

        $scholarship->fill($request->only(['sk_number', 'start_scholarship', 'end_scholarship']));

        if ($request->hasFile('sk_file')) {
            if ($scholarship->sk_file) {
                Storage::delete($scholarship->sk_file);
            }

            $sk_filePath = $request->file('sk_file')->store('sk_file', 'public');
            $scholarship->sk_file = $sk_filePath;
        }

        $scholarship->save();

        return redirect()->route('pengelolaan-khusus.index')
            ->with('success', 'Berhasil mengupdate SK beasiswa');
    }
}
