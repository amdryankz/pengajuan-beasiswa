<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Support\Facades\Storage;

class UserScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();
        $scholarships = ScholarshipData::where('start_regis_at', '<=', $now)
            ->where('end_regis_at', '>=', $now)
            ->where('status_scholarship', '=', 'Umum')
            ->get();

        return view('user.scholar.index')->with('data', $scholarships);
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

        foreach ($request->file_requirements as $file_requirement_id => $file) {
            $fileName = $file_requirement_id . '_' . $user->name . '.' . $file->extension();
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
        $filerequirements = FileRequirement::all();

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
        //
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
            return response()->download($path);
        } else {
            abort(404, 'File not found');
        }
    }

    public function validateFile($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status = true;
            $userScholarship->save();
        }

        return redirect()->back()->with('success', 'Berkas telah divalidasi.');
    }

    public function cancelValidation($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status = false;
            $userScholarship->save();
        }

        return redirect()->back()->with('success', 'Berkas batal divalidasi.');
    }
}