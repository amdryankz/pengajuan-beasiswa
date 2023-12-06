<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipData;
use App\Models\UserScholarship;

class DashboardController extends Controller
{
    public function index()
    {
        $totalScholarship = ScholarshipData::count();

        $totalAlumni = UserScholarship::where('status_file', true)
            ->where('status_scholar', true)
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.end_scholarship', '<', now())
            ->count();

        $totalActive = UserScholarship::where('status_file', true)
            ->where('status_scholar', true)
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.start_scholarship', '<=', now())
            ->where('scholarship_data.end_scholarship', '>=', now())
            ->count();

        $totalActiveByScholarship = ScholarshipData::withCount([
            'users' => function ($query) {
                $query->where('status_file', true)
                    ->where('status_scholar', true)
                    ->where('start_scholarship', '<=', now())
                    ->where('end_scholarship', '>=', now());
            },
        ])->get();

        return view('admin.homepage.index', compact('totalScholarship', 'totalAlumni', 'totalActive', 'totalActiveByScholarship'));
    }
}
