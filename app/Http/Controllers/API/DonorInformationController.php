<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DonorInformationController extends Controller
{
    public function updateProfile(Request $request)
    {
        try {
            $donor = Auth::guard('donor')->user();

            if (!$donor) {
                return response()->json([
                    'status' => false,
                    'message' => 'المستخدم غير مسجل الدخول'
                ], 401);
            }

            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'phone' => ['sometimes', 'nullable', 'string', Rule::unique('donors', 'phone')->ignore($donor->id)],
                'password' => 'sometimes|nullable|string|min:6',
                'gender' => 'sometimes|required|in:male,female,ذكر,انثى',
                'country' => 'sometimes|required|string',
            ]);

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpg,jpeg,png|max:10240'
                ]);

                if ($donor->avatar) {
                    Storage::disk('public')->delete($donor->avatar);
                }

                $path = $request->file('avatar')->store('DonorsAvtar', 'public');
                $validatedData['avatar'] = $path;
            }

            if (isset($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $donor->update($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'تم التحديث بنجاح',
                'donor' => $donor->refresh()
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'خطأ في التحقق من البيانات.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ أثناء تحديث الملف الشخصي.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
