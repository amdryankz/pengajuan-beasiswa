<?php

namespace App\Http\Controllers\Admin;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Announcement::all();

        return view('admin.announcement.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'letter_number' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        $imageName = 'Gambar ' . $data['title'] . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->storeAs('announcements', $imageName, 'public');
        $data['image'] = $imagePath;

        Announcement::create($data);

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil menambahkan data pengumuman');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Announcement::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $data = Announcement::findOrFail($id);
        }

        return view('admin.announcement.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = Announcement::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $data = Announcement::findOrFail($id);
        }

        return view('admin.announcement.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'letter_number' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        $announcement = Announcement::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete($announcement->image);
            $imageName = 'Gambar ' . $data['title'] . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('announcements', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Berhasil mengupdate data pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = Announcement::findOrFail($id);
        $scholarship->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil menghapus Data Pengumuman');
    }
}
