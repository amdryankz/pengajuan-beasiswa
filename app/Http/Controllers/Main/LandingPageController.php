<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\Annonuncement;
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
            $announcement = Annonuncement::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $announcement = Annonuncement::findOrFail($id);
        }

        return view('main.landingpage.show', ['pengumuman' => $announcement]);
    }
}
