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
        $user->phone_number = $request->input('phone_number');
        $user->bank_account_number = $request->input('bank_account_number');
        $user->account_holder_name = $request->input('account_holder_name');
        $user->bank_name = $request->input('bank_name');
        $user->parent_name = $request->input('parent_name');
        $user->parent_income = $request->input('parent_income');
        $user->parent_job = $request->input('parent_job');
        $user->address = $request->input('address');

        // Save the changes
        $user->save();

        return redirect()->route('biodata.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
