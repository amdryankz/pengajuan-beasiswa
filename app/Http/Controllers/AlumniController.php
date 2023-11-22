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

    // public function index()
    // {
    //     $scholarships = ScholarshipData::all();
    //     $data = [];

    //     foreach ($scholarships as $scholarship) {
    //         $users = $scholarship->users()->distinct()->get();

    //         foreach ($users as $user) {
    //             $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

    //             // Hitung waktu berakhir beasiswa
    //             $alumniEndDate = $scholarship->start_regis_at->addMonths($scholarship->duration);

    //             if (
    //                 $userScholarship &&
    //                 $userScholarship->pivot->status_file &&
    //                 $userScholarship->pivot->status_scholar &&
    //                 now() >= $alumniEndDate
    //             ) {
    //                 $data[] = [
    //                     'scholarship' => $scholarship,
    //                     'user' => $user,
    //                 ];
    //             }
    //         }
    //     }

    //     return view('admin.alumni.index')->with('data', $data);
    // }
}
