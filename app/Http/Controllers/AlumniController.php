<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipData;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserScholarshipExport;

class AlumniController extends Controller
{

    public function index()
    {
        $scholarships = ScholarshipData::where('end_scholarship', '<', now())->get();

        return view('admin.alumni.list')->with('scholarships', $scholarships);
    }

    public function showAlumniByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            abort(404);
        }

        $data = [];
        $users = $scholarship->users()->distinct()->get();

        foreach ($users as $user) {
            $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();
            $alumniEndDate = $scholarship->end_scholarship;

            if (
                $userScholarship &&
                $userScholarship->pivot->status_file &&
                $userScholarship->pivot->status_scholar &&
                now() > $alumniEndDate
            ) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                ];
            }
        }

        return view('admin.alumni.index')->with('data', $data);
    }

    public function export($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            abort(404);
        }

        $data = [];
        $users = $scholarship->users()->distinct()->get();

        foreach ($users as $user) {
            $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();
            $alumniEndDate = $scholarship->end_scholarship;

            if (
                $userScholarship &&
                $userScholarship->pivot->status_file &&
                $userScholarship->pivot->status_scholar &&
                now() > $alumniEndDate
            ) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                ];
            }
        }

        $export = new UserScholarshipExport($data, $scholarship->name);

        return Excel::download($export, 'userScholarhips.xlsx');
    }
}
