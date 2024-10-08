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

        return view('admin.passfile.index')->with('data', $data)->with('scholarship', $scholarship)->with('facultyList', $facultyList);
    }

    public function showDetail(string $user_id, string $scholarship_id)
{
    $user = User::findOrFail($user_id);
    $scholarship = ScholarshipData::findOrFail($scholarship_id);

    $files = UserScholarship::with('files')
        ->where('user_id', $user_id)
        ->where('scholarship_data_id', $scholarship_id)
        ->get();

    // Ambil kuota beasiswa untuk fakultas yang sesuai
    $quota = json_decode($scholarship->quota, true);

    // jumlah mahasiswa yang sudah divalidasi untuk fakultas
    $validatedCount = UserScholarship::where('scholarship_data_id', $scholarship_id)
        ->whereHas('user', function ($query) use ($user) {
            $query->where('faculty', $user->faculty);
        })
        ->where('scholarship_status', true)
        ->count();

    // Cek apakah kuota untuk fakultas ini sudah terpenuhi
    $quotaExceeded = $validatedCount >= $quota[$user->faculty];

    return view('admin.passfile.detail')
        ->with('user', $user)
        ->with('scholarship', $scholarship)
        ->with('files', $files)
        ->with('quotaExceeded', $quotaExceeded); // Kirim variabel $quotaExceeded ke view
}

    

   public function validateScholar($scholarship_id, $user_id)
{
    $scholarshipData = ScholarshipData::findOrFail($scholarship_id);

    // Ambil kuota beasiswa untuk fakultas yang sesuai
    $quota = json_decode($scholarshipData->quota, true);

    $user = User::findOrFail($user_id);

    $faculty = $user->faculty;

    // jumlah mahasiswa yang sudah divalidasi untuk fakultas
    $validatedCount = UserScholarship::where('scholarship_data_id', $scholarship_id)
        ->whereHas('user', function ($query) use ($faculty) {
            $query->where('faculty', $faculty);
        })
        ->where('scholarship_status', true)
        ->count();

    // Cek apakah kuota untuk fakultas ini sudah terpenuhi
    $quotaExceeded = $validatedCount >= $quota[$faculty];

    if ($quotaExceeded) {
        return redirect()->back()->with('error', 'Kuota untuk fakultas ' . $faculty . ' sudah terpenuhi.')
            ->with('quotaExceeded', $quotaExceeded);
    }

    $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)
        ->where('user_id', $user_id)
        ->get();

    foreach ($userScholarships as $userScholarship) {
        $userScholarship->scholarship_status = true;
        $userScholarship->save();
    }

    // Kirim email pemberitahuan bahwa mahasiswa dinyatakan lulus beasiswa
    Mail::to($user->email)->send(new ScholarshipValidated($user->name, $scholarshipData->scholarship->name));

    // Redirect ke halaman detail beasiswa dengan pesan sukses
    return redirect('/adm/kelulusan/' . $scholarship_id)->with('success', 'Mahasiswa lulus beasiswa.')
        ->with('quotaExceeded', $quotaExceeded);
}

    public function cancelValidation($scholarship_id, $user_id)
{
    $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)
        ->where('user_id', $user_id)
        ->get();

    foreach ($userScholarships as $userScholarship) {
        $userScholarship->scholarship_status = false;
        $userScholarship->save();
    }

    $user = User::findOrFail($user_id);
    $scholarship = ScholarshipData::findOrFail($scholarship_id);

    // Send email notification
    $mailData = new \stdClass();
    $mailData->name = $user->name;
    $mailData->scholarshipName = $scholarship->scholarship->name; 

    Mail::to($user->email)
        ->send(new ScholarshipValidationCancelled($mailData->name, $mailData->scholarshipName));

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
