<?php

namespace App\Services;

use Google\Client; // مكتبة Google API client
use Illuminate\Support\Facades\Http; // لإرسال طلبات HTTP
use Illuminate\Support\Facades\Storage; // للتعامل مع الملفات المخزنة

class FCMService 
{
    protected $projectId; // معرف مشروع Firebase
    protected $client;    // كائن الاتصال مع Google

    public function __construct()
    {
        // جلب معرف المشروع من ملف config/services.php
        $this->projectId = config('services.fcm.project_id'); // الآن نستخدم الاسم الصحيح من config

        // إنشاء كائن جديد من Google\Client
        $this->client = new Client();

        // تحميل بيانات المصادقة (من ملف JSON الخاص بـ Firebase)
        $this->client->setAuthConfig(storage_path(config('services.fcm.credentials'))); // المسار الصحيح لملف البيانات

        // تحديد الصلاحيات (نستخدم فقط Firebase Cloud Messaging)
        $this->client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        // توليد Access Token تلقائي باستخدام بيانات الخدمة
        $this->client->fetchAccessTokenWithAssertion();
    }

    // دالة إرسال الإشعار
    public function sendNotification($deviceToken, $title, $body)
    {
        // بناء محتوى الإشعار بالشكل المطلوب لـ FCM V1
        $message = [
            'message' => [
                'token' => $deviceToken, // توكن الجهاز المستهدف
                'notification' => [      // محتوى الإشعار (عنوان ونص)
                    'title' => $title,
                    'body' => $body,
                ],
                'android' => [           // إعدادات إضافية لأجهزة Android
                    'priority' => 'high',
                ],
                'apns' => [              // إعدادات إضافية لأجهزة Apple
                    'headers' => [
                        'apns-priority' => '10',
                    ],
                ],
            ],
        ];

        // الحصول على التوكن للوصول إلى FCM API
        $accessToken = $this->client->getAccessToken()['access_token'];

        // إرسال الطلب إلى Firebase
        $response = Http::withToken($accessToken)
            ->post("https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send", $message);

        // إرجاع الاستجابة (JSON)
        return $response->json();
    }
}
