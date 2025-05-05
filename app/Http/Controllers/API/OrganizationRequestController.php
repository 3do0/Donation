<?php

namespace App\Http\Controllers\API;

use App\Events\TestNotification;
use App\Http\Controllers\Controller;
use App\Mail\OrganizationRequestReceived;
use App\Models\Organization;
use App\Models\OrganizationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class OrganizationRequestController extends Controller
{
    public function organizationRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizations,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'activity_type' => 'required',
            'registration_number' => 'required|string',
            'bank_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'web_url' => 'nullable|url',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'license' => 'required|file|mimes:pdf|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try {
            DB::beginTransaction();

            $logoPath = $request->file('logo')->store('OrganizationsLogos', 'public');
            $licensePath = $request->file('license')->store('OrganizationsLicenses', 'public');

            $organization = Organization::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'activity_type' => implode(',', $request->activity_type),
                'registration_number' => $request->registration_number,
                'bank_name' => $request->bank_name,
                'bank_account_number' => $request->bank_account_number,
                'web_url' => $request->web_url,
                'logo' => $logoPath,
                'license' => $licensePath,
            ]);

            Mail::to($organization->email)->send(new OrganizationRequestReceived($organization));

            $msg = '🏢 تم تقديم طلب تسجيل جديد من منظمة: ' . $organization->name;

            broadcast(new TestNotification([
                'title' => '📝 طلب تسجيل منظمة',
                'content' => $msg,
            ]));

            DB::commit();

            return response()->json([
                'message' => 'تم استلام طلب الانضمام إلى تكافل',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'حدث خطأ أثناء تنفيذ العملية.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
