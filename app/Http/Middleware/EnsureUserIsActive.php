<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsActive
{
    public function handle($request, Closure $next)
    {
        // التحقق من حالة المستخدم
        if (Auth::check() && !Auth::user()->is_active) {
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'تم تعطيل حسابك من قبل الإدارة.',
            ]);
        }

        return $next($request);
    }
}

