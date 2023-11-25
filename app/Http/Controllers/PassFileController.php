<?php

namespace App\Http\Controllers;

use App\Exports\UserScholarshipExport;
use Illuminate\Http\Request;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Facades\Excel;

class PassFileController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $scholarships = ScholarshipData::where('name', 'like', '%' . $search . '%')->get();

        return view('admin.passfile.list')->with(['scholarships' => $scholarships, 'search' => $search]);
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

    public function validateScholar($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_scholar = true;
            $userScholarship->save();
        }

        return redirect()->back()->with('success', 'Mahasiswa lulus beasiswa.');
    }

    public function cancelValidation($scholarship_id)
    {
        $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship_id)->get();

        foreach ($userScholarships as $userScholarship) {
            $userScholarship->status_scholar = false;
            $userScholarship->save();
        }

        return redirect()->back()->with('success', 'Mahasiswa tidak lulus beasiswa.');
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
