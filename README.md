# تكافل — الواجهة الخلفية (الإصدار المنشور)

الواجهة الخلفية لمنصة **تكافل** للتبرعات كما هي منشورة على Railway، وهي تطوير لمستودع [TakafulProject](https://github.com/3do0/TakafulProject) بإضافة الإشعارات الفورية (Firebase Cloud Messaging)، البث اللحظي للأحداث، وتعليقات المتبرعين.

تخدم ثلاث فئات: المتبرعين عبر REST API (Sanctum) تستهلكه واجهة [Takaful_ye](https://github.com/3do0/Takaful_ye)، والجمعيات والمشرفين عبر لوحتي تحكم Livewire.

## ما الجديد مقارنة بالإصدار الأول

- **إشعارات Push** للمتبرعين عبر FCM v1 (`App\Services\FCMService`) مع تخزين رموز الأجهزة
- **أحداث لحظية** (`App\Events`) عند إنشاء الحالات والمشاريع واستقبال التبرعات والرد على الطلبات، تُبث عبر Reverb/Pusher
- **تعليقات المتبرعين** على الحالات والمشاريع، وعدّادات زيارات لكل منها
- **مركز إشعارات** للمتبرع مع تحديث حالة القراءة
- إعادة إرسال رمز OTP
- إعداد نشر جاهز لـ Railway عبر `nixpacks.toml` مع رفع حد الملفات المرفوعة إلى 100MB

## التقنيات

| المجال        | الأداة                                              |
| ------------- | --------------------------------------------------- |
| الإطار        | Laravel 11 / PHP 8.2                                |
| المصادقة      | Laravel Breeze (لوحات التحكم)، Sanctum (API)         |
| الواجهات      | Livewire 3، Livewire PowerGrid، Tailwind CSS، Vite  |
| المدفوعات     | stripe/stripe-php، paytabscom/laravel_paytabs        |
| الإشعارات     | google/apiclient (FCM v1)، kreait/laravel-firebase   |
| البث اللحظي   | Laravel Reverb / pusher/pusher-php-server            |
| OTP           | ichtrojan/laravel-otp                               |
| السجلات       | spatie/laravel-activitylog                          |
