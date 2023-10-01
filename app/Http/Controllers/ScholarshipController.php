<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ScholarshipData::with('donor')->get();
        $filerequirements = FileRequirement::all();

        return view('admin.scholar.index')->with('data', $data)->with('file', $filerequirements);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Donor::all();
        $filerequirements = FileRequirement::all();

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
            'status_scholarship' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'status_value' => 'required|string|max:255',
            'duration' => 'required|integer',
            'start_regis_at' => 'required|date',
            'end_regis_at' => 'required|date|after_or_equal:start_regis_at',
            'min_ipk' => 'required|numeric',
            'start_graduation_at' => 'required|date',
            'end_graduation_at' => 'required|date|after_or_equal:start_graduation_at',
            'kuota' => 'required|array',
            'kuota.*' => 'required|integer',
            'no_sk' => 'string|nullable|max:255',
            'file_sk' => 'string|nullable|max:255',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
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
            'status_scholarship' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'status_value' => 'required|string|max:255',
            'duration' => 'required|integer',
            'start_regis_at' => 'required|date',
            'end_regis_at' => 'required|date|after_or_equal:start_regis_at',
            'min_ipk' => 'required|numeric',
            'start_graduation_at' => 'required|date',
            'end_graduation_at' => 'required|date|after_or_equal:start_graduation_at',
            'kuota' => 'required|array',
            'kuota.*' => 'required|integer',
            'no_sk' => 'string|nullable|max:255',
            'file_sk' => 'string|nullable|max:255',
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
}
