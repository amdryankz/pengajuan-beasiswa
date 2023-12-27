<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserScholarshipExport;
use App\Http\Controllers\Controller;
use App\Models\ScholarshipData;
use App\Models\User;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Facades\Excel;

class StudentScholarshipController extends Controller
{
    public function index()
    {
        $scholarships = ScholarshipData::where('start_scholarship', '<=', now())
            ->where('end_scholarship', '>=', now())->get();

        return view('admin.aplicant.list')->with('scholarships', $scholarships);
    }

    public function showAplicantByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            abort(404);
        }

        $data = [];
        $users = $scholarship->users()->distinct()->get();

        $fakultasList = User::select('fakultas')->distinct()->pluck('fakultas')->toArray();

        foreach ($users as $user) {
            $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

            if (
                $userScholarship &&
                $userScholarship->pivot->status_file &&
                $userScholarship->pivot->status_scholar &&
                $scholarship->start_scholarship <= now() &&
                now() <= $scholarship->end_scholarship
            ) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                    'fakultasList' => $fakultasList,
                ];
            }
        }

        return view('admin.aplicant.index')->with('data', $data)->with('scholarship', $scholarship);
    }

    public function showDetail(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $files = UserScholarship::where('user_id', $user_id)
            ->where('scholarship_data_id', $scholarship_id)
            ->get();

        return view('admin.aplicant.detail')
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

            if (
                $userScholarship &&
                $userScholarship->pivot->status_file &&
                $userScholarship->pivot->status_scholar &&
                $scholarship->start_scholarship <= now() &&
                now() <= $scholarship->end_scholarship
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
