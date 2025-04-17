<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Donor;
use App\Models\DonorFeedback;
use App\Models\OrganizationCase;
use App\Models\OrganizationProject;
use App\Models\OrganizationUser;
use App\Models\PlatformDonation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $donor = Donor::first();  // سيتم استخدام أول متبرع في قاعدة البيانات

        // if (!$donor) {
        //     $donor = Donor::create([ // في حال لم يكن هناك متبرعين، يمكنك إنشاء متبرع أولي
        //         'name' => 'أحمد الفقية',
        //         'email' => 'ahmed@example.com',
        //         'phone' => '123456789',
        //         'address' => 'صنعاء، اليمن',
        //     ]);
        // }

        // // 2. إنشاء تبرع جديد
        // $donation = Donation::create([
        //     'donor_id' => $donor->id,  // ربط التبرع بالمتبرع
        //     'guest_name' => null, // لا حاجة للاسم في حال المتبرع مسجل
        //     'guest_email' => null, // لا حاجة للبريد في حال المتبرع مسجل
        //     'total_amount' => 15000, // المبلغ الكلي للتبرع
        //     'currency' => 'YER',
        //     'payment_method' => 'stripe',
        //     'status' => 'pending',
        // ]);

        // // 3. إضافة تبرع لحالة معينة
        // $case = OrganizationCase::first();  // أول حالة موجودة في قاعدة البيانات
        // if ($case) {
        //     DonationItem::create([
        //         'donation_id' => $donation->id,
        //         'donatable_type' => OrganizationCase::class,
        //         'donatable_id' => $case->id, // ID الحالة
        //         'amount' => 10000,  // المبلغ المخصص لهذه الحالة
        //     ]);
        // }


        // DonationItem::create([
        //     'donation_id' => $donation->id,
        //     'donatable_type' => 'App\Models\PlatformDonation',  // تحديد أنه وهمي
        //     'donatable_id' => 1,  // يتم تحديد قيمة وهمية فقط
        //     'amount' => 5000,  // المبلغ المخصص للمنصة
        // ]);
        // User::factory(10)->create();

        // OrganizationUser::create([
        //     'organization_id' => '202501003',
        //     'name' => 'Yasser Nabeel Ali',
        //     'email' => 'yaser.alhbaby@gmail.com',
        //     'password' => '00000000',
        //     'photo' => 'yasser11@gmail.com',
        //     'phone' => '7777777700',
        // ]);

        // $case = OrganizationProject::first(); // اختر الحالة الأولى أو يمكنك تخصيصها حسب الحاجة

        // // العثور على متبرع معين
        // $donor = Donor::first(); // اختر المتبرع الأول أو يمكنك تخصيصه حسب الحاجة

        // // إضافة تعليق للحالة باستخدام علاقة polymorphic
        // DonorFeedback::create([
        //     'donor_id' => $donor->id, // ID المتبرع
        //     'feedbackable_id' => $case->id, // ID الحالة
        //     'feedbackable_type' => OrganizationProject::class, // نوع الحالة
        //     'rating' => 4, // التقييم
        //     'comment' => "هذا تعليق تجريبي على هذه الحالة", // نص التعليق
        // ]);

        $user = User::create([
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'password' => bcrypt('00000000'),
            'phone' => '123456789',
            
        ]);

    }
}
