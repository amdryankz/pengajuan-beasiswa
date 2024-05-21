<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScholarshipData;
use App\Models\User;
use App\Models\UserScholarship;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
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

        // Calculate totals by faculty
        $totalsByFaculty = UserScholarship::where('file_status', true)
            ->where('scholarship_status', true)
            ->join('users', 'user_scholarships.user_id', '=', 'users.id')
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.start_scholarship', '<=', now())
            ->where('scholarship_data.end_scholarship', '>=', now())
            ->select('users.faculty', DB::raw('count(*) as total'))
            ->groupBy('users.faculty')
            ->pluck('total', 'users.faculty');

        return view('admin.homepage.index', compact('totalScholarship', 'totalAlumni', 'totalActive', 'totalsByFaculty', 'facultyList'));
    }
}
