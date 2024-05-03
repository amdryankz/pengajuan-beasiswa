<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\ScholarshipValidated;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserScholarshipExport;
use App\Mail\ScholarshipValidationCancelled;

class StudentApprovalController extends Controller
{
    public function index()
    {
        $scholarships = ScholarshipData::with('scholarship')->get();

        return view('admin.passfile.list')->with('scholarships', $scholarships);
    }

    public function showPassFileByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::with('users')->findOrFail($scholarship_id);

        $data = [];
        $users = $scholarship->users->unique('id');

        $facultyList = $users->pluck('faculty')->unique();

        foreach ($users as $user) {
            $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

            if ($userScholarship && $userScholarship->pivot->file_status) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                    'facultyList' => $facultyList,
                ];
            }
        }

        return view('admin.passfile.index')->with('data', $data)->with('scholarship', $scholarship);
    }

    public function showDetail(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $files = UserScholarship::with('files')->where('user_id', $user_id)
            ->where('scholarship_data_id', $scholarship_id)
            ->get();

        return view('admin.passfile.detail')->with('user', $user)
            ->with('scholarship', $scholarship)
            ->with('files', $files);
    }

    public function validateScholar($scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->scholarship_status = true;
            $userScholarship->save();
        }

        Mail::to($userScholarship->user->email)->send(new ScholarshipValidated());

        return redirect('/adm/kelulusan/' . $scholarship_id)->with('success', 'Mahasiswa lulus beasiswa.');
    }

    public function cancelValidation($scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->scholarship_status = false;
            $userScholarship->save();
        }

        Mail::to($userScholarship->user->email)->send(new ScholarshipValidationCancelled());

        return redirect('/adm/kelulusan/' . $scholarship_id)->with('success', 'Mahasiswa tidak lulus beasiswa.');
    }

    public function export($scholarship_id)
    {
        $scholarship = ScholarshipData::with('users')->findOrFail($scholarship_id);

        $data = [];
        $users = $scholarship->users->unique('id');

        foreach ($users as $user) {
            $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

            if ($userScholarship && $userScholarship->pivot->file_status) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                ];
            }
        }

        $export = new UserScholarshipExport($data, $scholarship->scholarship->name);

        $fileName = 'Mahasiswa lulus berkas ' . $scholarship->scholarship->name . ' ' . $scholarship->year . '.xlsx';

        return Excel::download($export, $fileName);
    }
}
