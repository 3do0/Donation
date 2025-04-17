<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\OrganizationProfileUpdateRequest;
use App\Models\OrganizationUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrganizationProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('organization.profile.edit', [
            'organizationUser' => Auth::guard('organization')->user(),
        ]);
    }

    public function update(OrganizationProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        /** @var OrganizationUser $user */
        $user = Auth::guard('organization')->user();

        if (isset($validated['currency'])) {
            Cookie::queue('currency', $validated['currency'], 60 * 24 * 365);
        }

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
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('organization.profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password:organization'],
        ]);

        /** @var OrganizationUser $user */
        $user = Auth::guard('organization')->user();

        Auth::guard('organization')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
