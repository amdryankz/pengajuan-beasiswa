<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserScholarshipExport;

class PassFileController extends Controller
{

    public function index()
    {
        $scholarships = ScholarshipData::all();

        return view('admin.passfile.list')->with('scholarships', $scholarships);
    }

    public function showPassFileByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            // Handle jika beasiswa tidak ditemukan
            abort(404);
        }

        $data = [];
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

        return view('admin.passfile.index')->with('data', $data)->with('scholarship', $scholarship);;
    }

    public function showDetail(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $files = UserScholarship::where('user_id', $user_id)
            ->where('scholarship_data_id', $scholarship_id)
            ->get();

        return view('admin.passfile.detail')
            ->with('user', $user)
            ->with('scholarship', $scholarship)
            ->with('files', $files);
    }

    public function validateScholar($scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_scholar = true;
            $userScholarship->save();
        }

        return redirect('/adm/passfile/' . $scholarship_id)->with('success', 'Mahasiswa lulus beasiswa.');
    }

    public function cancelValidation($scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_scholar = false;
            $userScholarship->save();
        }

        return redirect('/adm/passfile/' . $scholarship_id)->with('success', 'Mahasiswa tidak lulus beasiswa.');
    }

    public function export($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            // Handle jika beasiswa tidak ditemukan
            abort(404);
        }

        $data = [];
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

        $export = new UserScholarshipExport($data, $scholarship->name);

        return Excel::download($export, 'userScholarhips.xlsx');
    }
}
