<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserScholarshipExport;
use App\Http\Controllers\Controller;
use App\Models\ScholarshipData;
use App\Models\User;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Facades\Excel;

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

        $facultyList = User::select('faculty')->distinct()->pluck('faculty')->toArray();

        foreach ($users as $user) {
            $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();
            $alumniEndDate = $scholarship->end_scholarship;

            if (
                $userScholarship &&
                $userScholarship->pivot->file_status &&
                $userScholarship->pivot->scholarship_status &&
                now() > $alumniEndDate
            ) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                    'facultyList' => $facultyList,
                ];
            }
        }

        return view('admin.alumni.index')->with('data', $data)->with('scholarship', $scholarship);
    }

    public function showDetail(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $files = UserScholarship::where('user_id', $user_id)
            ->where('scholarship_data_id', $scholarship_id)
            ->get();

        return view('admin.alumni.detail')
            ->with('user', $user)
            ->with('scholarship', $scholarship)
            ->with('files', $files);
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
                $userScholarship->pivot->file_status &&
                $userScholarship->pivot->scholarship_status &&
                now() > $alumniEndDate
            ) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                ];
            }
        }

        $export = new UserScholarshipExport($data, $scholarship->scholarship->name);

        return Excel::download($export, 'userScholarhips.xlsx');
    }
}
