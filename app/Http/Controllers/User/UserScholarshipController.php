<?php

namespace App\Http\Controllers\User;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use App\Http\Controllers\Controller;
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

        $scholarships = ScholarshipData::with('scholarship')->where('start_registration_at', '<=', $now)
            ->where('end_registration_at', '>=', $now)
            ->get();

        $userScholarships = UserScholarship::with('scholarshipData')->where('user_id', $userId)->get();

        $filteredUserScholarships = $userScholarships->unique('scholarship_data_id');

        $alumniData = ScholarshipData::where('end_scholarship', '<', $now)
            ->whereIn('id', $filteredUserScholarships->pluck('scholarship_data_id'))
            ->whereHas('users', function ($query) {
                $query->where('file_status', true)
                    ->where('scholarship_status', true);
            })
            ->get();

        return view('user.scholar.index')->with('data', $scholarships)->with('dataUser', $filteredUserScholarships)->with('alumniData', $alumniData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_requirements.*' => 'required|mimes:pdf|max:2048',
            'supervisor_approval_file' => 'required|mimes:pdf|max:2048',
        ]);

        $user = $request->user();
        $scholarshipDataId = $request->input('scholarship_data_id');
        $scholarship = ScholarshipData::findOrFail($scholarshipDataId);

        if ($user->ipk < $scholarship->min_ipk) {
            return redirect()->route('pendaftaran.index')->with('error', 'IPK Anda tidak memenuhi syarat untuk mendaftar beasiswa ini.');
        }

        $requiredFields = [
            'phone_number', 'bank_account_number', 'account_holder_name',
            'bank_name', 'parent_name', 'parent_income', 'parent_job', 'address', 'email'
        ];

        foreach ($requiredFields as $field) {
            if (empty($user->$field)) {
                return redirect()->route('pendaftaran.index')->with('error', 'Lengkapi biodata Anda terlebih dahulu.');
            }
        }

        $client = new Client();
        $response = $client->request('GET', 'https://api.hunter.io/v2/email-verifier', [
            'query' => [
                'email' => $user->email,
                'api_key' => env('HUNTER_API_KEY'),
            ]
        ]);

        $emailVerification = json_decode($response->getBody(), true);

        if ($emailVerification['data']['result'] !== 'deliverable') {
            return redirect()->route('pendaftaran.index')->with('error', 'Alamat email Anda tidak valid atau tidak dapat ditemukan.');
        }

        if (UserScholarship::where('user_id', $user->id)
            ->where('scholarship_data_id', $scholarshipDataId)
            ->exists()
        ) {
            return redirect()->route('pendaftaran.index')->with('error', 'Anda sudah mendaftar untuk beasiswa ini.');
        }

        if (UserScholarship::where('user_id', $user->id)
            ->where('scholarship_status', true)
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.end_scholarship', '>=', now())
            ->exists()
        ) {
            return redirect()->route('pendaftaran.index')->with('error', 'Anda sudah memiliki beasiswa aktif.');
        }

        $dosenWaliLetter = $request->file('supervisor_approval_file');
        $dosenWaliFileName = $user->npm . '_Izin Dosen Wali.' . $dosenWaliLetter->getClientOriginalExtension();
        $dosenWaliLetter->storeAs('file_requirements', $dosenWaliFileName, 'public');

        foreach ($request->file_requirements as $file_requirement_id => $file) {
            $fileRequirement = FileRequirement::findOrFail($file_requirement_id);
            $fileName = $user->npm . '_' . $fileRequirement->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs('file_requirements', $fileName, 'public');

            UserScholarship::create([
                'scholarship_data_id' => $scholarshipDataId,
                'user_id' => $user->id,
                'file_requirement_id' => $file_requirement_id,
                'file_path' => $fileName,
                'supervisor_approval_file' => $dosenWaliFileName
            ]);
        }

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $scholarship = ScholarshipData::findOrFail($id);
        $filerequirements = $scholarship->requirements;

        return view('user.scholar.show')->with('fileRequirements', $filerequirements)->with('scholarship', $scholarship);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userScholarship = UserScholarship::findOrFail($id);

        if ($userScholarship->file_status === null) {
            $filePaths = UserScholarship::where('user_id', $userScholarship->user_id)
                ->where('scholarship_data_id', $userScholarship->scholarship_data_id)
                ->pluck('file_path')
                ->toArray();

            foreach ($filePaths as $filePath) {
                if ($filePath) {
                    Storage::disk('public')->delete('file_requirements/' . $filePath);
                }
            }

            if ($userScholarship->supervisor_approval_file) {
                Storage::disk('public')->delete('file_requirements/' . $userScholarship->supervisor_approval_file);
            }

            UserScholarship::where('user_id', $userScholarship->user_id)
                ->where('scholarship_data_id', $userScholarship->scholarship_data_id)
                ->delete();

            return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dibatalkan.');
        } else {
            return redirect()->route('pendaftaran.index')->with('error', 'Anda tidak dapat membatalkan pendaftaran karena status berkas sudah diatur.');
        }
    }
}
