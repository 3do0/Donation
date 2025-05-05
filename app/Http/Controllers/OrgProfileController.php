<?php

namespace App\Http\Controllers;

use App\Http\Requests\orgProfileUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrgProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.orgEdit', [
            'Orguser' => $request->user('organization'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(orgProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (isset($validated['currency'])) {
            Cookie::queue(
                'currency', 
                $validated['currency'], 
                60 * 24 * 365 
            );
        }
    
        $user = $request->user();
        
    
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->storeAs(
                'images',
                $request->file('photo')->hashName(),
                'public'
            );
            $validated['photo'] = $photoPath;
            // $user->photo = $photoPath;
        }
    
        $user->fill($validated);
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();
    
        return Redirect::route('Orgprofile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
