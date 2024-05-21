<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $totalScholarship = ScholarshipData::count();

        $totalAlumni = UserScholarship::where('file_status', true)
            ->where('scholarship_status', true)
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.end_scholarship', '<', now())
            ->count();

        $totalActive = UserScholarship::where('file_status', true)
            ->where('scholarship_status', true)
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.start_scholarship', '<=', now())
            ->where('scholarship_data.end_scholarship', '>=', now())
            ->count();

        $facultyList = User::select('faculty')->distinct()->pluck('faculty')->toArray();

        $scholarshipList = ScholarshipData::join('scholarships', 'scholarships.id', '=', 'scholarship_data.scholarships_id')
            ->distinct()
            ->pluck('scholarships.name', 'scholarships.id')
            ->toArray();

        $selectedScholarshipId = $request->input('scholarship_id');

        $totalsByFacultyQuery = UserScholarship::where('file_status', true)
            ->where('scholarship_status', true)
            ->join('users', 'user_scholarships.user_id', '=', 'users.id')
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.start_scholarship', '<=', now())
            ->where('scholarship_data.end_scholarship', '>=', now());

        if ($selectedScholarshipId) {
            $totalsByFacultyQuery->where('scholarship_data.scholarships_id', $selectedScholarshipId);
        }

        $totalsByFaculty = $totalsByFacultyQuery->select('users.faculty', DB::raw('count(*) as total'))
            ->groupBy('users.faculty')
            ->pluck('total', 'users.faculty')
            ->toArray();

        $totalsByFaculty = array_merge(array_fill_keys($facultyList, 0), $totalsByFaculty);

        return view('admin.homepage.index', compact('totalScholarship', 'totalAlumni', 'totalActive', 'totalsByFaculty', 'facultyList', 'scholarshipList', 'selectedScholarshipId'));
    }
}
