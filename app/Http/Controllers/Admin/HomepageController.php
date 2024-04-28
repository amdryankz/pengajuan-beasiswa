<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScholarshipData;
use App\Models\User;
use App\Models\UserScholarship;

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

        $totalScholarships = ScholarshipData::with('users')->get();

        $totalsByFaculty = collect();
        $facultyList = User::select('faculty')->distinct()->pluck('faculty')->toArray();

        foreach ($totalScholarships as $scholarship) {
            $facultyTotals = $scholarship->users()
                ->wherePivot('file_status', true)
                ->wherePivot('scholarship_status', true)
                ->get()
                ->groupBy('faculty')
                ->map(function ($facultyUsers) {
                    return $facultyUsers->count();
                });

            $scholarshipData[$scholarship->id] = [
                'name' => optional($scholarship->scholarship)->name,
                'year' => $scholarship->year,
                'facultyTotals' => $facultyTotals,
                'total' => $facultyTotals->sum(),
            ];
        }

        $scholarshipData = empty($scholarshipData) ? null : $scholarshipData;

        return view('admin.homepage.index', compact('totalScholarship', 'totalAlumni', 'totalActive', 'totalsByFaculty', 'facultyList', 'scholarshipData'));
    }
}
