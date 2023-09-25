<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileRequirement;
use Illuminate\Support\Facades\Session;

class FileRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FileRequirement::orderby('name', 'asc')->get();
        return view('admin.filereq.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.filereq.create');
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
            'name.required' => 'Berkas wajib diisi'
        ]);

        $data = ['name' => $request->name];

        FileRequirement::create($data);

        return redirect()->route('berkas.index')->with('success', 'Berhasil menambahkan data');
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
        $data = FileRequirement::findOrFail($id);
        return view('admin.filereq.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required'], ['name.required' => 'Nama berkas wajib diisi']);

        $data = ['name' => $request->name];

        FileRequirement::findOrFail($id)->update($data);

        return redirect()->route('berkas.index')->with('success', 'Berhasil update berkas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fileRequirement = FileRequirement::findOrFail($id);

        if ($fileRequirement->requireFiles()->count() > 0) {
            return redirect()->back()->withErrors(['error' => 'Tidak dapat menghapus persyaratan ini karena masih terdapat beasiswa yang terkait.']);
        }

        $fileRequirement->delete();

        return redirect()->route('berkas.index')->with('success', 'Berhasil delete berkas');
    }
}