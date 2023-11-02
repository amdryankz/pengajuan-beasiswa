<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Models\ScholarshipData;
use App\Models\SpecScholarship;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SpecScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SpecScholarship::distinct('scholarship_data_id')->get();

        return view('admin.specscholarship.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = ScholarshipData::where('status_scholarship', '=', 'Khusus')->get();

        return view('admin.specscholarship.create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'scholarship_data_id' => 'required',
            'list_students' => 'required|file|mimes:csv,txt,xlsx'
        ]);

        $scholarship_data_id = $request->input('scholarship_data_id');

        // Import data dari berkas
        Excel::import(new StudentsImport($scholarship_data_id), $request->file('list_students'));

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('khusus.index')->with('success', 'Data mahasiswa berhasil diimpor.');
    }

    /**
     * Display the specified resource.
     */
    public function showList(string $scholarship_data_id)
    {
        $students = SpecScholarship::where('scholarship_data_id', $scholarship_data_id)->pluck('list_students');

        if ($students->count() > 0) {
            return view('admin.specscholarship.show', compact('students'));
        }
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
        //
    }
}
