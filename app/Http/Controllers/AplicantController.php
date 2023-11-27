<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;

class AplicantController extends Controller
{

    public function index()
    {
        $scholarships = ScholarshipData::all();
        return view('admin.aplicant.list')->with('scholarships', $scholarships);
    }

    public function showAplicantByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            // Handle jika beasiswa tidak ditemukan
            abort(404);
        }

        $data = [];
        $users = $scholarship->users()->distinct()->get();

        foreach ($users as $user) {
            $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

            if ($userScholarship && $userScholarship->pivot->status_file && $userScholarship->pivot->status_scholar) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                ];
            }
        }

        return view('admin.aplicant.index')->with('data', $data);
    }
}
