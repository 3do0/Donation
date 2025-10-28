# REST API

كل المسارات تحت `/api`. المسارات المعلّمة بـ 🔒 تتطلب `Authorization: Bearer <token>` (Sanctum).

## عام

| الطريقة | المسار                        | الوصف                          |
| ------- | ----------------------------- | ------------------------------ |
| GET     | `/cases-data`                 | الحالات المنشورة               |
| GET     | `/projects-data`              | المشاريع المنشورة              |
| GET     | `/takaful-statistics`         | إحصائيات المنصة                |
| GET     | `/takaful-partners`           | الشركاء                        |
| GET     | `/currency-rates`             | أسعار العملات                  |
| GET     | `/convert-currency`           | تحويل مبلغ إلى الريال اليمني   |
| POST    | `/org-req`                    | طلب انضمام جمعية               |
| POST    | `/device-token`               | تسجيل رمز جهاز لإشعارات FCM    |
| POST    | `/cases/increase-visitors`    | زيادة عدّاد زيارات حالة        |
| POST    | `/projects/increase-visitors` | زيادة عدّاد زيارات مشروع       |

## حساب المتبرع

| الطريقة | المسار                       | الوصف                          |
| ------- | ---------------------------- | ------------------------------ |
| POST    | `/donors/register`           | إنشاء حساب وإرسال OTP          |
| POST    | `/donors/verify-otp`         | تفعيل الحساب                   |
| POST    | `/donors/resend-otp`         | إعادة إرسال الرمز              |
| POST    | `/donors/login`              | تسجيل الدخول                   |
| POST    | `/donors/logout` 🔒          | إلغاء الرمز                    |
| POST    | `/donors/forgot-password`    | OTP لإعادة التعيين             |
| POST    | `/donors/reset-password`     | كلمة مرور جديدة                |
| POST    | `/donors/update-profile` 🔒  | تحديث الملف الشخصي             |
| GET     | `/user` 🔒                   | المستخدم الحالي                |

## التبرعات والتفاعل

| الطريقة | المسار                        | الوصف                                   |
| ------- | ----------------------------- | --------------------------------------- |
| POST    | `/create-checkout-session`    | إنشاء جلسة Stripe Checkout              |
| POST    | `/stripe/webhook`             | استقبال أحداث Stripe (موقّعة)           |
| GET     | `/donor/donations` 🔒         | تبرعات المتبرع                          |
| GET     | `/donor/donations-summary` 🔒 | ملخص التبرعات                           |
| GET     | `/donor/notifications` 🔒     | إشعارات المتبرع                         |
| POST    | `/notifications/update`       | تحديث حالة قراءة إشعار                  |
| POST    | `/case-comment` 🔒            | تعليق على حالة                          |
| POST    | `/project-comment` 🔒         | تعليق على مشروع                         |
