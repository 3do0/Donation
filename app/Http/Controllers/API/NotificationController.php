<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        try {
            $donor = Auth::guard('donor')->user();

            if (!$donor) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'لم يتم العثور على المتبرع.',
                ], 404);
            }

            $notifications = Notification::where('donor_id', $donor->id)
                ->orderBy('created_at', 'desc')
                ->get();

            if ($notifications->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'لا توجد إشعارات لهذا المتبرع.',
                    'notifications' => [],
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'count' => $notifications->count(),
                'notifications' => $notifications,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'بيانات غير صحيحة.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ غير متوقع. حاول لاحقًا.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
