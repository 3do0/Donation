<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() && !Auth::guard('admin')->user()->is_active) {
            Auth::guard('admin')->logout();
            return redirect('/login')->withErrors([
                'email' => 'تم تعطيل حسابك من قبل الإدارة.',
            ]);
        }

        if (Auth::guard('organization')->check() && !Auth::guard('organization')->user()->is_active) {
            Auth::guard('organization')->logout();
            return redirect('organization/login')->withErrors([
                'email' => 'تم تعطيل حسابك من قبل الإدارة.',
            ]);
        }


        return $next($request);
    }
}

