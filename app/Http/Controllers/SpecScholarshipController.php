<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Donor;
use App\Models\ScholarshipData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SpecScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ScholarshipData::with('donor')->whereNotNull('start_scholarship')->whereNull('start_regis_at')->get();

        return view('admin.specscholarship.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Donor::all();

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
            'name' => 'required|string|max:255',
            'year' => 'required|integer',
            'donors_id' => 'required|exists:donors,id',
            'value' => 'required|string|max:255',
            'status_value' => 'required|string|max:255',
            'duration' => 'required|integer',
            'start_scholarship' => 'required|date',
            'end_scholarship' => 'required|date|after_or_equal:start_scholarship',
            'list_student_file' => 'required|file|mimes:xlsx',
        ]);

        $scholarship = ScholarshipData::create($data);

        Excel::import(new StudentsImport($scholarship->id), $request->file('list_student_file'));

        $scholarship->update([
            'list_student_file' => $request->file('list_student_file')->store('list_student_file', 'public'),
        ]);

        return redirect()->route('khusus.index')
            ->with('success', 'Scholarship created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function showList(string $scholarship_data_id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
        $scholarship->delete();

        return redirect()->route('khusus.index');
    }
}
