<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Donor::all();

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
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        Donor::create($request->all());

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
        try {
            $data = Donor::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $data = Donor::findOrFail($id);
        }

        return view('admin.donor.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        Donor::findOrFail($id)->update($request->all());

        return redirect()->route('donatur.index')->with('success', 'Berhasil update donatur');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donor = Donor::findOrFail($id);

        if ($donor->scholarships()->count() > 0) {
            return redirect()->route('donatur.index')->with('error', 'Tidak dapat menghapus donatur ini karena masih terdapat beasiswa yang terkait.');
        }

        $donor->delete();

        return redirect()->route('donatur.index')->with('success', 'Berhasil menghapus Donatur');
    }
}
