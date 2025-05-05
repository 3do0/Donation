<?php

namespace App\Http\Controllers\API;

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
            $notifications_not_read_count = Notification::where('donor_id', $donor->id)->where('is_read', 0)->count();

            return response()->json([
                'status' => 'success',
                'notifications' => $notifications->map(function ($notification) {
                    return [
                        'notification_id' => $notification->id,
                        'title' => $notification->title,
                        'message' => $notification->message,
                        'is_read' => $notification->is_read,
                        'created_at' => $notification->created_at ? $notification->created_at->format('Y-m-d H:i:s') :  'غير متوفر',
                    ];
                }),
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

    public function updateReadStatus(Request $request)
    {
        $request->validate([
            'notificationId' => 'required|exists:notifications,id',
        ]);

        $notification = Notification::find($request->notificationId);
        $notification->update(['is_read' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث عدد المشاهدات بنجاح',
            'is_read' => $notification->is_read ,
        ]);
    }
}
