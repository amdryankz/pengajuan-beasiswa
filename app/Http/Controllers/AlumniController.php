<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarshipData;

class AlumniController extends Controller
{

    public function index()
    {
        $scholarships = ScholarshipData::all();
        return view('admin.alumni.list')->with('scholarships', $scholarships);
    }

    public function showAlumniByScholarship($scholarship_id)
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
            $alumniEndDate = $scholarship->start_regis_at->addMonths($scholarship->duration);

            if (
                $userScholarship &&
                $userScholarship->pivot->status_file &&
                $userScholarship->pivot->status_scholar &&
                now() >= $alumniEndDate
            ) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                ];
            }
        }

        return view('admin.alumni.index')->with('data', $data);
    }
}
