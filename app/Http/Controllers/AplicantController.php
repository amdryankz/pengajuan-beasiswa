<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarshipData;

class AplicantController extends Controller
{
    public function index()
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

        return view('admin.aplicant.index')->with('data', $data);
    }

    public function indexPass()
    {
        $scholarships = ScholarshipData::all();
        $data = [];

        foreach ($scholarships as $scholarship) {
            $users = $scholarship->users()->distinct()->get();

            foreach ($users as $user) {
                $userScholarship = $user->scholarships->where('id', $scholarship->id)->first();

                if ($userScholarship && $userScholarship->pivot->status) {
                    $data[] = [
                        'scholarship' => $scholarship,
                        'user' => $user,
                    ];
                }
            }
        }

        return view('admin.passfile.index')->with('data', $data);
    }
}
