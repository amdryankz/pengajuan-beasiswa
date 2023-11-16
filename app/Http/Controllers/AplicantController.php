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
        $data = [];

        foreach ($scholarships as $scholarship) {
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
        }

        return view('admin.aplicant.index')->with('data', $data);
    }

    public function indexPass()
    {
        $scholarships = ScholarshipData::all();
        $data = [];

        foreach ($scholarships as $scholarship) {
            $users = $scholarship->users()->distinct()->get();

            foreach ($users as $user) {
                $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

                if ($userScholarship && $userScholarship->pivot->status_file) {
                    $data[] = [
                        'scholarship' => $scholarship,
                        'user' => $user,
                    ];
                }
            }
        }

        return view('admin.passfile.index')->with('data', $data);
    }

    public function indexAlumni()
    {
        $scholarships = ScholarshipData::all();
        $data = [];

        foreach ($scholarships as $scholarship) {
            $users = $scholarship->users()->distinct()->get();

            foreach ($users as $user) {
                $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

                // Hitung waktu berakhir beasiswa
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
        }

        return view('admin.alumni.index')->with('data', $data);
    }

    public function validateScholar($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_scholar = true;
            $userScholarship->save();
        }

        return redirect()->back()->with('success', 'Mahasiswa lulus beasiswa.');
    }

    public function cancelValidation($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_scholar = false;
            $userScholarship->save();
        }

        return redirect()->back()->with('success', 'Mahasiswa batal lulus beasiswa.');
    }
}
