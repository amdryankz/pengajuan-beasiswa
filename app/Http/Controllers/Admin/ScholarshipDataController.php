<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileRequirement;
use App\Models\Scholarship;
use App\Models\ScholarshipData;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScholarshipDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ScholarshipData::with('scholarship')->whereNotNull('start_registration_at')->get();

        return view('admin.scholar.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Scholarship::all();
        $filerequirements = FileRequirement::get();

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
            'scholarships_id' => 'required|exists:scholarships,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'amount' => 'required|integer|min:0',
            'amount_period' => 'required|string|max:5',
            'duration' => 'required|integer|min:1',
            'start_registration_at' => 'required|date',
            'end_registration_at' => 'required|date|after_or_equal:start_registration_at',
            'min_ipk' => 'required|numeric|min:0|max:4',
            'quota' => 'required|array',
            'quota.*' => 'required|integer',
        ]);

        $quota = $request->input('quota');
        $quotaJSON = json_encode($quota);

        $data = $request->except('quota');
        $data['quota'] = $quotaJSON;

        $scholarshipData = ScholarshipData::create($data);

        if ($request->has('requirements')) {
            $scholarshipData->requirements()->attach($request->requirements);
        }

        return redirect()->route('pengelolaan.index')->with('success', 'Berhasil menambahkan data beasiswa');
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

        $data = Scholarship::all();
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
            'scholarships_id' => 'required|exists:scholarships,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'amount' => 'required|integer|min:0',
            'amount_period' => 'required|string|max:5',
            'duration' => 'required|integer|min:1',
            'start_registration_at' => 'required|date',
            'end_registration_at' => 'required|date|after_or_equal:start_registration_at',
            'min_ipk' => 'required|numeric|min:0|max:4',
            'quota' => 'required|array',
            'quota.*' => 'required|integer',
        ]);

        $quota = $request->input('quota');
        $quotaJSON = json_encode($quota);

        $data = $request->except(['quota', '_method', '_token']);
        $data['quota'] = $quotaJSON;

        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->update($data);

        if ($request->has('requirements')) {
            $scholarship->requirements()->sync($request->requirements);
        } else {
            $scholarship->requirements()->detach();
        }

        return redirect()->route('pengelolaan.index')->with('success', 'Berhasil mengupdate data beasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->requirements()->detach();
        $scholarship->delete();

        return redirect()->route('pengelolaan.index')->with('success', 'Berhasil menghapus Data Beasiswa');
    }

    public function updateSK(Request $request, string $id)
    {
        $request->validate([
            'sk_number' => 'required|string|max:50',
            'sk_file' => 'required|mimes:pdf|max:2048',
            'start_scholarship' => 'required|date',
            'end_scholarship' => 'required|date|after_or_equal:start_scholarship',
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

        return redirect()->route('pengelolaan.index')->with('success', 'Berhasil mengupdate SK beasiswa');
    }
}
