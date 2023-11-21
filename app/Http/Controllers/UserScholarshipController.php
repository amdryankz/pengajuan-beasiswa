<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $now = Carbon::now();

        $scholarships = ScholarshipData::where('start_regis_at', '<=', $now)
            ->where('end_regis_at', '>=', $now)
            ->where('status_scholarship', '=', 'Umum')
            ->get();

        $userScholarships = UserScholarship::where('user_id', $userId)->get();

        $alumniData = [];
        foreach ($userScholarships as $userScholarship) {
            $scholarshipId = $userScholarship->scholarship_id;

            // Pastikan beasiswa masih ada di antara yang sedang berlangsung
            $scholarship = $scholarships->where('id', $scholarshipId)->first();
            if ($scholarship) {
                // Hitung waktu berakhir beasiswa (alumni dimulai setelah waktu berakhir)
                $alumniEndDate = $scholarship->start_regis_at->addMonths($scholarship->duration);

                if ($now >= $alumniEndDate) {
                    $alumniData[] = [
                        'scholarship' => $scholarship,
                        'userScholarship' => $userScholarship,
                    ];
                }
            }
        }

        return view('user.scholar.index')->with('data', $scholarships)->with('dataUser', $userScholarships)->with('alumniData', $alumniData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_requirements.*' => 'required|mimes:pdf|max:2048'
        ]);

        $scholarshipDataId = $request->input('scholarship_data_id');
        $user = $request->user();
        $userIpk = $user->ipk;

        // Dapatkan informasi beasiswa
        $scholarship = ScholarshipData::findOrFail($scholarshipDataId);
        $minIpkRequired = $scholarship->min_ipk;

        // Verifikasi IPK
        if ($userIpk < $minIpkRequired) {
            return redirect()->route('dashboard.index')->with('error', 'IPK Anda tidak memenuhi syarat untuk mendaftar beasiswa ini.');
        }

        // Verifikasi apakah pengguna sudah mendaftar
        $existingRegistration = UserScholarship::where('user_id', $user->id)
            ->where('scholarship_data_id', $scholarshipDataId)
            ->exists();

        if ($existingRegistration) {
            return redirect()->route('dashboard.index')->with('error', 'Anda sudah mendaftar untuk beasiswa ini.');
        }

        foreach ($request->file_requirements as $file_requirement_id => $file) {
            $fileName = $user->nim . '.' . $file->getClientOriginalExtension();
            $file->storeAs('file_requirements', $fileName);

            UserScholarship::create([
                'scholarship_data_id' => $scholarshipDataId,
                'user_id' => $user->id,
                'file_requirement_id' => $file_requirement_id,
                'file_path' => $fileName,
            ]);
        }

        return redirect()->route('dashboard.index')->with('success', 'Pendaftaran berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
        $filerequirements = $scholarship->requirements;

        return view('user.scholar.show')
            ->with('fileRequirements', $filerequirements)
            ->with('scholarship', $scholarship);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userScholarship = UserScholarship::findOrFail($id);

        // Verifikasi apakah pengguna dapat membatalkan pendaftaran
        if ($userScholarship->status_file === null) {
            // Hapus berkas terkait jika ada (optional)
            if ($userScholarship->file_path) {
                Storage::delete('file_requirements/' . $userScholarship->file_path);
            }

            // Hapus pendaftaran
            $userScholarship->delete();

            return redirect()->route('dashboard.index')->with('success', 'Pendaftaran berhasil dibatalkan.');
        } else {
            return redirect()->route('dashboard.index')->with('error', 'Anda tidak dapat membatalkan pendaftaran karena status berkas sudah diatur.');
        }
    }

    public function showScholarships()
    {
        $scholarships = ScholarshipData::all();
        return view('admin.userscholarship.list')->with('scholarships', $scholarships);
    }

    public function showRegistrationsByScholarship($scholarship_id)
    {
        $scholarship = ScholarshipData::find($scholarship_id);

        if (!$scholarship) {
            // Handle jika beasiswa tidak ditemukan
            abort(404);
        }

        $user = $scholarship->users()->distinct()->get();

        $data = [
            'scholarship' => $scholarship,
            'user' => $user,
        ];

        return view('admin.userscholarship.index')->with('data', $data);
    }

    public function showRegistrations()
    {
        $scholarships = ScholarshipData::all();
        $data = [];

        foreach ($scholarships as $scholarship) {
            $users = $scholarship->users()->distinct()->get();

            foreach ($users as $user) {
                $data[] = [
                    'scholarship' => $scholarship,
                    'user' => $user,
                ];
            }
        }

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

    public function validateFile($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_file = true;
            $userScholarship->save();
        }


        return redirect()->back()->with('success', 'Berkas telah divalidasi.');
    }

    public function cancelValidation($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_file = false;
            $userScholarship->save();
        }

        return redirect()->back()->with('success', 'Berkas batal divalidasi.');
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
