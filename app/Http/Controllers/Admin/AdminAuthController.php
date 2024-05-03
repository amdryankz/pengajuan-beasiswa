<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'nip' => ['required', 'numeric'],
            'password' => ['required']
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            if ($user->status !== 'Aktif') {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Account is not active');

                return redirect('/adm');
            }

            $request->session()->regenerate();
            return redirect('/adm/beranda');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Invalid credentials');

        return redirect('/adm');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/adm');
    }
}
