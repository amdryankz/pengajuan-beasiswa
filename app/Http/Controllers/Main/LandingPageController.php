<?php

namespace App\Http\Controllers\Main;

use App\Models\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = Announcement::all(); // Mengambil semua data berita beasiswa
        return view('main.landingpage.index', ['data' => $data]);
    }

    public function show(string $slug)
    {
        try {
            $announcement = Announcement::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $announcement = Announcement::findOrFail($slug);
        }

        // Get other news excluding the current one
        $otherNews = Announcement::where('slug', '!=', $slug)->take(6)->get();

        return view('main.landingpage.show', [
            'pengumuman' => $announcement,
            'otherNews' => $otherNews
        ]);
    }
}
