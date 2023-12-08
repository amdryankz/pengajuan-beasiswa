<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;

class HomepageController extends Controller
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

        $totalScholarships = ScholarshipData::with('users')->get();

        $totalsByFaculty = collect();
        $fakultasList = User::select('fakultas')->distinct()->pluck('fakultas')->toArray();

        foreach ($totalScholarships as $scholarship) {
            $facultyTotals = $scholarship->users()
                ->wherePivot('status_file', true)
                ->wherePivot('status_scholar', true)
                ->get()
                ->groupBy('fakultas')
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

        return view('admin.homepage.index', compact('totalScholarship', 'totalAlumni', 'totalActive', 'totalsByFaculty', 'fakultasList', 'scholarshipData'));
    }
}
