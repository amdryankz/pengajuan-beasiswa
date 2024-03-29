<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use App\Http\Controllers\Controller;

class StudentApplicationController extends Controller
{
    public function showScholarships()
    {
        $scholarships = ScholarshipData::all();

        return view('admin.userscholarship.list')->with('scholarships', $scholarships);
    }

    public function showRegistrationsByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            abort(404);
        }

        $user = $scholarship->users()->distinct()->get();

        $fakultasList = User::select('fakultas')->distinct()->pluck('fakultas')->toArray();

        $data = [
            'scholarship' => $scholarship,
            'user' => $user,
            'fakultasList' => $fakultasList,
        ];

        return view('admin.userscholarship.index')->with('data', $data);
    }

    public function showDetail(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $files = UserScholarship::where('user_id', $user_id)
            ->where('scholarship_data_id', $scholarship_id)
            ->get();

        return view('admin.userscholarship.detail')
            ->with('user', $user)
            ->with('scholarship', $scholarship)
            ->with('files', $files);
    }

    public function downloadFile($file_path)
    {
        $path = storage_path('app/file_requirements/' . $file_path);

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
            $userScholarship->status_file = true;
            $userScholarship->reason_for_rejection = null;
            $userScholarship->save();
        }

        return redirect('/adm/pengusul/' . $scholarship_id)->with('success', 'Berkas telah divalidasi.');
    }

    public function cancelValidation(Request $request, $scholarship_id, $user_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->where('user_id', $user_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_file = false;
            $userScholarship->status_scholar = null;
            $userScholarship->reason_for_rejection = $request->input('reason');
            $userScholarship->save();
        }

        return redirect('/adm/pengusul/' . $scholarship_id)->with('success', 'Berkas batal divalidasi.');
    }


    public function generatePDF(string $user_id, string $scholarship_id)
    {
        $user = User::findOrFail($user_id);
        $scholarship = ScholarshipData::findOrFail($scholarship_id);

        $pdf = PDF::loadView('admin.pdf.biodata', compact('user', 'scholarship'));

        // Nama file PDF yang akan diunduh
        $pdfFileName = $user->nim . '_' . $scholarship->name . '.pdf';

        // Unduh file PDF
        return $pdf->stream($pdfFileName);
    }
}
