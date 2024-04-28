<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileRequirement;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FileRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FileRequirement::all();

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
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        FileRequirement::create($request->all());

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
        try {
            $data = FileRequirement::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $data = FileRequirement::findOrFail($id);
        }

        return view('admin.filereq.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        FileRequirement::findOrFail($id)->update($request->all());

        return redirect()->route('berkas.index')->with('success', 'Berhasil update berkas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fileRequirement = FileRequirement::findOrFail($id);

        if ($fileRequirement->fileScholarships()->count() > 0) {
            return redirect()->back()->withErrors(['error' => 'Tidak dapat menghapus berkas ini karena masih terdapat beasiswa yang terkait.']);
        }

        $fileRequirement->delete();

        return redirect()->route('berkas.index')->with('success', 'Berhasil hapus berkas');
    }
}
