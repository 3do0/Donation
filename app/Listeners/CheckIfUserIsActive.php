<?php

namespace App\Listeners;

use Closure;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckIfUserIsActive
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_active) {
            Auth::logout();  // تسجيل الخروج
            return redirect('/login')->with('error', 'تم تعطيل حسابك من قبل الإدارة.');
        }

        return $next($request);
    }
}

