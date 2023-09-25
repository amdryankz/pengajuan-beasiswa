<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Donor::orderby('name', 'asc')->get();

        return view('admin.donor.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.donor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi'
        ]);

        $data = ['name' => $request->name];

        Donor::create($data);

        return redirect()->route('donatur.index')->with('success', 'Berhasil menambahkan data');
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
        $data = Donor::findOrFail($id);
        return view('admin.donor.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi'
        ]);

        $data = ['name' => $request->name];

        Donor::findOrFail($id)->update($data);

        return redirect()->route('donatur.index')->with('success', 'Berhasil update donatur');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donor = Donor::findOrFail($id);

        if ($donor->scholarshipData()->count() > 0) {
            return redirect()->back()->withErrors(['error' => 'Tidak dapat menghapus donor ini karena masih terdapat beasiswa yang terkait.']);
        }

        $donor->delete();
        return redirect()->route('donatur.index')->with('success', 'Berhasil delete donatur');
    }
}
