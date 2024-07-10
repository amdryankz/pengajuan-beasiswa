<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use App\Mail\FileValidated;
use Illuminate\Http\Request;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\FileValidationCancelled;

class StudentApplicationController extends Controller
{
    public function showScholarships()
    {
        $scholarships = ScholarshipData::with('scholarship')->get();

        return view('admin.userscholarship.list')->with('scholarships', $scholarships);
    }

    public function showRegistrationsByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::with('users')->findOrFail($scholarship_id);

        $users = $scholarship->users->unique('id');

        $facultyList = $users->pluck('faculty')->unique();

        $data = [
            'scholarship' => $scholarship,
            'user' => $users,
            'facultyList' => $facultyList,
        ];

        return view('admin.userscholarship.index')->with('data', $data);
    }

    public function showDetail(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $files = UserScholarship::with('files')->where('user_id', $user_id)
            ->where('scholarship_data_id', $scholarship_id)
            ->get();

        return view('admin.userscholarship.detail')->with('user', $user)
            ->with('scholarship', $scholarship)
            ->with('files', $files);
    }

    public function checkFile($file_path)
    {
        $path = public_path('storage/file_requirements/' . $file_path);

        if (file_exists($path)) {
            $filename = pathinfo($path, PATHINFO_FILENAME);

            return response()->stream(
                function () use ($path) {
                    readfile($path);
                },
                200,
                [
                    'Content-Type' => mime_content_type($path),
                    'Content-Disposition' => 'inline; filename="' . $filename . '"',
                ]
            );
        } else {
            abort(404, 'File not found');
        }
    }

    public function validateFile($scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->file_status = true;
            $userScholarship->rejection_reason = null;
            $userScholarship->save();
        }

        Mail::to($userScholarship->user->email)->send(new FileValidated());

        return redirect('/adm/pengusul/' . $scholarship_id)->with('success', 'Berkas persyaratan telah divalidasi.');
    }

    public function cancelValidation(Request $request, $scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->file_status = false;
            $userScholarship->scholarship_status = null;
            $userScholarship->rejection_reason = $request->input('reason');
            $userScholarship->save();
        }

        Mail::to($userScholarship->user->email)->send(new FileValidationCancelled($userScholarship->rejection_reason));

        return redirect('/adm/pengusul/' . $scholarship_id)->with('success', 'Berkas persyaratan ditolak.');
    }

    public function generatePDF(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $pdf = PDF::loadView('admin.pdf.biodata', compact('user', 'scholarship'));

        $pdfFileName = $user->npm . '_' . $scholarship->name . '.pdf';

        return $pdf->stream($pdfFileName);
    }
}
