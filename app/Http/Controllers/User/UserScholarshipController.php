<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            ->get();

        $userScholarships = UserScholarship::where('user_id', $userId)->get();

        $filteredUserScholarships = $userScholarships->unique('scholarship_data_id');

        $alumniData = ScholarshipData::where('end_scholarship', '<', $now)
            ->whereIn('id', $filteredUserScholarships->pluck('scholarship_data_id'))
            ->whereHas('users', function ($query) {
                $query->where('status_file', true)
                    ->where('status_scholar', true);
            })
            ->get();

        return view('user.scholar.index')->with('data', $scholarships)->with('dataUser', $filteredUserScholarships)->with('alumniData', $alumniData);
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
            'file_requirements.*' => 'required|mimes:pdf|max:2048',
            'dosen_wali_approval' => 'required|mimes:pdf|max:2048',
        ], [
            'file_requirements.*.max' => 'File tidak boleh lebih dari 2MB',
            'dosen_wali_approval.max' => 'File tidak boleh lebih dari 2MB',
        ]);

        $scholarshipDataId = $request->input('scholarship_data_id');
        $user = $request->user();
        $userIpk = $user->ipk;

        $scholarship = ScholarshipData::findOrFail($scholarshipDataId);
        $minIpkRequired = $scholarship->min_ipk;

        if ($userIpk < $minIpkRequired) {
            return redirect()->route('beasiswa.index')->with('error', 'IPK Anda tidak memenuhi syarat untuk mendaftar beasiswa ini.');
        }

        $existingRegistration = UserScholarship::where('user_id', $user->id)
            ->where('scholarship_data_id', $scholarshipDataId)
            ->exists();

        if ($existingRegistration) {
            return redirect()->route('beasiswa.index')->with('error', 'Anda sudah mendaftar untuk beasiswa ini.');
        }

        $activeScholarship = UserScholarship::where('user_id', $user->id)
            ->where('status_scholar', true)
            ->join('scholarship_data', 'user_scholarships.scholarship_data_id', '=', 'scholarship_data.id')
            ->where('scholarship_data.end_scholarship', '>=', now())
            ->exists();

        if ($activeScholarship) {
            return redirect()->route('beasiswa.index')->with('error', 'Anda sudah memiliki beasiswa aktif.');
        }

        $dosenWaliLetter = $request->file('dosen_wali_approval');
        $dosenWaliFileName = $user->nim . '_izin_dosen_wali.' . $dosenWaliLetter->getClientOriginalExtension();
        $dosenWaliLetter->storeAs('dosen_wali_letters', $dosenWaliFileName, 'public');

        foreach ($request->file_requirements as $file_requirement_id => $file) {
            $fileRequirement = FileRequirement::findOrFail($file_requirement_id);
            $fileName = $user->nim . '_' . $fileRequirement->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs('file_requirements', $fileName, 'public');

            UserScholarship::create([
                'scholarship_data_id' => $scholarshipDataId,
                'user_id' => $user->id,
                'file_requirement_id' => $file_requirement_id,
                'file_path' => $fileName,
                'dosen_wali_approval' => $dosenWaliFileName
            ]);
        }

        return redirect()->route('beasiswa.index')->with('success', 'Pendaftaran berhasil.');
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

        if ($userScholarship->status_file === null) {
            $filePaths = UserScholarship::where('user_id', $userScholarship->user_id)
                ->where('scholarship_data_id', $userScholarship->scholarship_data_id)
                ->pluck('file_path')
                ->toArray();

            foreach ($filePaths as $filePath) {
                if ($filePath) {
                    Storage::disk('public')->delete('file_requirements/' . $filePath);
                }
            }

            if ($userScholarship->dosen_wali_approval) {
                Storage::disk('public')->delete('dosen_wali_letters/' . $userScholarship->dosen_wali_approval);
            }

            UserScholarship::where('user_id', $userScholarship->user_id)
                ->where('scholarship_data_id', $userScholarship->scholarship_data_id)
                ->delete();

            return redirect()->route('beasiswa.index')->with('success', 'Pendaftaran berhasil dibatalkan.');
        } else {
            return redirect()->route('beasiswa.index')->with('error', 'Anda tidak dapat membatalkan pendaftaran karena status berkas sudah diatur.');
        }
    }
}
