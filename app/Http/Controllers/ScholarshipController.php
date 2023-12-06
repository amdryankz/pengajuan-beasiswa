<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Scholarship;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Scholarship::orderby('name', 'asc')->get();

        return view('admin.scholarship.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $donor = Donor::all();

        return view('admin.scholarship.create')->with('donor', $donor);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'donors_id' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'donors_id.required' => 'Donatur wajib diisi',
        ]);

        $data = [
            'name' => $request->name,
            'donors_id' => $request->donors_id,
        ];

        Scholarship::create($data);

        return redirect()->route('beasiswa.index')->with('success', 'Berhasil menambahkan beasiswa');
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
        try {
            $data = Scholarship::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $data = Scholarship::findOrFail($id);
        }

        $donor = Donor::all();

        return view('admin.scholarship.edit')->with('data', $data)->with('donor', $donor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'donors_id' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'donors_id.required' => 'Donatur wajib diisi',
        ]);

        $data = [
            'name' => $request->name,
            'donors_id' => $request->donors_id,
        ];

        Scholarship::findOrFail($id)->update($data);

        return redirect()->route('beasiswa.index')->with('success', 'Berhasil mengupdate beasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = Scholarship::find($id);

        if (! $scholarship) {
            return redirect()->route('beasiswa.index')->with('error', 'Beasiswa tidak ditemukan.');
        }

        if ($scholarship->scholarshipData()->count() > 0) {
            return redirect()->route('beasiswa.index')->with('error', 'Tidak dapat menghapus beasiswa ini karena masih terdapat data yang terkait.');
        }

        $scholarship->delete();

        return redirect()->route('beasiswa.index')->with('success', 'Berhasil menghapus Beasiswa');
    }
}
