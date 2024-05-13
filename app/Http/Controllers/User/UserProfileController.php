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
        $request->validate([
            'email' => 'required|string|email|max:50',
            'parent_name' => 'required|string|max:50',
            'parent_job' => 'required|string|max:25',
            'parent_income' => 'required|string|max:50',
            'phone_number' => 'required|numeric',
            'bank_account_number' => 'required|numeric',
            'account_holder_name' => 'required|string|max:50',
            'bank_name' => 'required|string|max:25',
        ]);

        User::findOrFail(Auth::id())->update($request->all());

        return redirect()->route('biodata.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
