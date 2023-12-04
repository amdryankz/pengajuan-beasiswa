<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ScholarshipData::with('donor')->whereNotNull('start_regis_at')->get();

        return view('admin.scholar.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Donor::all();
        $filerequirements = FileRequirement::paginate(5);

        $tahunSekarang = date('Y');
        $tahunArray = range($tahunSekarang, $tahunSekarang - 2);

        return view('admin.scholar.create')->with('data', $data)
            ->with('file', $filerequirements)
            ->with('tahunArray', $tahunArray);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer',
            'donors_id' => 'required|exists:donors,id',
            'value' => 'required|string|max:255',
            'status_value' => 'required|string|max:255',
            'duration' => 'required|integer',
            'start_regis_at' => 'required|date',
            'end_regis_at' => 'required|date|after_or_equal:start_regis_at',
            'min_ipk' => 'required|numeric',
            'kuota' => 'required|array',
            'kuota.*' => 'required|integer',
        ]);

        $kuota = $request->input('kuota');
        $kuotaJSON = json_encode($kuota);

        $data = $request->except('kuota');
        $data['kuota'] = $kuotaJSON;

        $scholarshipData = ScholarshipData::create($data);

        if ($request->has('requirements')) {
            $scholarshipData->requirements()->attach($request->requirements);
        }

        return redirect()->route('beasiswa.index')
            ->with('success', 'Scholarship created successfully');
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

        return view('admin.scholar.show', ['beasiswa' => $scholarship]);
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

        $data = Donor::all();
        $filerequirements = FileRequirement::all();

        $tahunSekarang = date('Y');
        $tahunArray = range($tahunSekarang, $tahunSekarang - 2);

        return view('admin.scholar.edit')->with('data', $data)
            ->with('file', $filerequirements)
            ->with('tahunArray', $tahunArray)
            ->with('scholarship', $scholarship);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer',
            'donors_id' => 'required|exists:donors,id',
            'value' => 'required|string|max:255',
            'status_value' => 'required|string|max:255',
            'duration' => 'required|integer',
            'start_regis_at' => 'required|date',
            'end_regis_at' => 'required|date|after_or_equal:start_regis_at',
            'min_ipk' => 'required|numeric',
            'kuota' => 'required|array',
            'kuota.*' => 'required|integer',
        ]);

        $kuota = $request->input('kuota');
        $kuotaJSON = json_encode($kuota);

        $data = $request->except(['kuota', '_method', '_token']);
        $data['kuota'] = $kuotaJSON;

        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->update($data);

        if ($request->has('requirements')) {
            $scholarship->requirements()->sync($request->requirements);
        } else {
            $scholarship->requirements()->detach();
        }

        return redirect()->route('beasiswa.index')
            ->with('success', 'Scholarship updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->requirements()->detach();
        $scholarship->delete();

        return redirect()->route('beasiswa.index');
    }

    public function updateSK(Request $request, string $id)
    {
        $request->validate([
            'no_sk' => 'nullable|string|max:255',
            'file_sk' => 'nullable|mimes:pdf|max:2048',
            'start_scholarship' => 'nullable|date',
            'end_scholarship' => 'nullable|date|after_or_equal:start_scholarship',
        ]);

        $scholarship = ScholarshipData::findOrFail($id);

        $scholarship->fill($request->only(['no_sk', 'start_scholarship', 'end_scholarship']));

        // Cek apakah file_sk diunggah
        if ($request->hasFile('file_sk')) {
            // Hapus file yang ada jika sudah ada
            if ($scholarship->file_sk) {
                // Hapus file yang sudah ada (optional, sesuai kebutuhan)
                Storage::delete($scholarship->file_sk);
            }

            // Simpan file yang diunggah ke penyimpanan (storage)
            $file_skPath = $request->file('file_sk')->store('file_sk', 'public');
            $scholarship->file_sk = $file_skPath;
        }

        // Simpan perubahan ke dalam database
        $scholarship->save();

        return redirect()->route('beasiswa.index')
            ->with('success', 'Scholarship updated successfully');
    }
}
