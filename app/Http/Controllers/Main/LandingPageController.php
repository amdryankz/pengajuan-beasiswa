<?php

namespace App\Http\Controllers\Main;

use App\Models\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('main.landingpage.index');
    }

    public function show(string $id)
    {
        try {
            $announcement = Announcement::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $announcement = Announcement::findOrFail($id);
        }

        return view('main.landingpage.show', ['pengumuman' => $announcement]);
    }
}
