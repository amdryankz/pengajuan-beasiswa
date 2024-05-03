<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'npm' => ['required', 'numeric'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/mhs/beranda');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Invalid credentials');

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
