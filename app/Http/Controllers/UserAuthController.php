<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'nim' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $request->session()->regenerate();
            return redirect('/mhs/dashboard');
        } else {
            // Authentication failed
            // Handle authentication failure here
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login Invalid');
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
