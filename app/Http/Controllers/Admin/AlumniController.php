<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserScholarshipExport;

class AlumniController extends Controller
{
    public function index()
    {
        $scholarships = ScholarshipData::with('scholarship')->where('end_scholarship', '<', now())->get();

        return view('admin.alumni.list')->with('scholarships', $scholarships);
    }

    public function showAlumniByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::with('users')->findOrFail($scholarship_id);

        $data = [];
        $users = $scholarship->users->unique('id');

        $facultyList = $users->pluck('faculty')->unique();

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

        return view('admin.alumni.index')->with('data', $data)->with('scholarship', $scholarship)->with('facultyList', $facultyList);
    }

    public function showDetail(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $files = UserScholarship::with('files')->where('user_id', $user_id)
            ->where('scholarship_data_id', $scholarship_id)
            ->get();

        return view('admin.alumni.detail')->with('user', $user)
            ->with('scholarship', $scholarship)
            ->with('files', $files);
    }

    public function export($scholarship_id)
    {
        $scholarship = ScholarshipData::with('users')->findOrFail($scholarship_id);

        $data = [];
        $users = $scholarship->users->unique('id');

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

        $fileName = 'Mahasiswa alumni ' . $scholarship->scholarship->name . ' ' . $scholarship->year . '.xlsx';

        return Excel::download($export, $fileName);
    }
}
