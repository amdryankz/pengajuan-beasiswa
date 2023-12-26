<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user.biodata.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // Update the user attributes
        $user->no_hp = $request->input('no_hp');
        $user->no_rek = $request->input('no_rek');
        $user->name_rek = $request->input('name_rek');
        $user->name_bank = $request->input('name_bank');
        $user->name_parent = $request->input('name_parent');
        $user->income_parent = $request->input('income_parent');
        $user->job_parent = $request->input('job_parent');
        $user->address = $request->input('address');

        // Save the changes
        $user->save();

        return redirect()->route('biodata.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
