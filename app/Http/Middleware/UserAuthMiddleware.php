<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            return redirect('/mhs/dashboard');
        }

        return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
    }
}
