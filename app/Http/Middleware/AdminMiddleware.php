<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::user());
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role->name === 'admin') {
            return $next($request);
        }

        return redirect()->route('authentications.login')->with('error', 'Silakan login sebagai admin.');
    }
}
