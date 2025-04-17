<?php

namespace App\Http\Controllers\Organization\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OrganizationLoginRequest;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('organization.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(OrganizationLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (!Auth::guard('organization')->attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'بيانات الاعتماد غير متطابقة.',
            ]);
        }
    
        if (!Auth::guard('organization')->user()->is_active) {
            Auth::guard('organization')->logout();
            return back()->withErrors([
                'email' => 'الحساب غير مفعّل. يرجى التواصل مع الدعم.',
            ]);
        }
    
        return redirect()->intended('organization/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('organization')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/organization/login');
    }
}
