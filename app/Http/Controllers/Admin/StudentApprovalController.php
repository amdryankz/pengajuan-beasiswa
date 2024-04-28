<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\ScholarValidated;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserScholarshipExport;
use App\Mail\ScholarValidationCancelled;

class StudentApprovalController extends Controller
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

        $facultyList = User::select('faculty')->distinct()->pluck('faculty')->toArray();

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
            $userScholarship->scholarship_status = true;
            $userScholarship->save();
        }

        Mail::to($userScholarship->user->email)->send(new ScholarValidated());

        return redirect('/adm/kelulusan/' . $scholarship_id)->with('success', 'Mahasiswa lulus beasiswa.');
    }

    public function cancelValidation($scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->scholarship_status = false;
            $userScholarship->save();
        }

        Mail::to($userScholarship->user->email)->send(new ScholarValidationCancelled());

        return redirect('/adm/kelulusan/' . $scholarship_id)->with('success', 'Mahasiswa tidak lulus beasiswa.');
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

            if ($userScholarship && $userScholarship->pivot->file_status) {
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
