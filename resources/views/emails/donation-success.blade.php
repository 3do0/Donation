<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد التبرع</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 20px; background-color: #f8f9fa; font-family: 'Tajawal', sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; padding: 32px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <!-- Quranic Verse -->
        <div style="background-color: #f8f9fa; border-radius: 12px; padding: 24px; margin-bottom: 32px; text-align: center; position: relative; border: 2px solid rgba(72, 187, 120, 0.1);">
            <p style="font-size: 18px; color: #2d3748; line-height: 1.8; margin-bottom: 8px;">
                مَّثَلُ الَّذِينَ يُنفِقُونَ أَمْوَالَهُمْ فِي سَبِيلِ اللَّهِ كَمَثَلِ حَبَّةٍ أَنبَتَتْ سَبْعَ سَنَابِلَ فِي كُلِّ سُنبُلَةٍ مِّائَةُ حَبَّةٍ ۗ وَاللَّهُ يُضَاعِفُ لِمَن يَشَاءُ
            </p>
            <p style="font-size: 14px; color: #48bb78; margin: 0;">سورة البقرة: 261</p>
        </div>

        <!-- Success Message -->
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="margin-bottom: 24px;">
                <svg width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="#48bb78" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto;">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h1 style="font-size: 28px; color: #1a202c; margin-bottom: 12px;">   عزيزي 
                <span style="color: coral;">{{ $donationDetails['donor_name'] }} </span>
                تم التبرع بنجاح! 🎉 </h1>
            <p style="font-size: 16px; color: #4a5568; line-height: 1.6; margin: 0;">
                شكراً لسخائك وكرمك. سيكون لتبرعك أثر كبير في مساعدة المحتاجين.
            </p>
        </div>

        <!-- Donation Details -->
        <div style="margin-bottom: 32px;">
            <!-- Amount -->
            <div style="background-color: #f7fafc; border-radius: 12px; padding: 20px; margin-bottom: 16px; border: 1px solid #e2e8f0;">
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #c6f6d5; border-radius: 50%; padding: 12px; margin-left: 16px; width:16px ; height:16px">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#48bb78" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <p style="font-size: 14px; color: #718096; margin: 0 0 4px 0;">مبلغ التبرع</p>
                        <p style="font-size: 20px; color: #2d3748; font-weight: bold; margin: 0;">
                            {{ $donationDetails['amount'] }}
                            @if ($donationDetails['currency'] == 'usd')
                            دولار أمريكي
                            @elseif ($donationDetails['currency'] == 'sar')
                            ريال سعودي
                            @else
                            ريال يمني
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Reference Number -->
            <div style="background-color: #f7fafc; border-radius: 12px; padding: 20px; margin-bottom: 16px; border: 1px solid #e2e8f0;">
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #bee3f8; border-radius: 50%; padding: 12px; margin-left: 16px; width:16px ; height:16px">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3182ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                    <div>
                        <p style="font-size: 14px; color: #718096; margin: 0 0 4px 0;">رقم الحالة</p>
                        <p style="font-size: 20px; color: #2d3748; font-weight: bold; margin: 0;">{{ $donationDetails['case_number'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Date -->
            <div style="background-color: #f7fafc; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0;">
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #e9d8fd; border-radius: 50%; padding: 12px; margin-left: 16px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#805ad5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <p style="font-size: 14px; color: #718096; margin: 0 0 4px 0;">تاريخ التبرع</p>
                        <p style="font-size: 20px; color: #2d3748; font-weight: bold; margin: 0;" id="donationDate">{{ $donationDetails['date'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; padding-top: 24px; border-top: 1px solid #e2e8f0;">
            <p style="color: #718096; line-height: 1.6; margin: 0;">
                {{ config('app.name') }}
                <br>
                <span style="color: #48bb78;">شكراً لدعمكم المستمر ❤️</span>
            </p>
        </div>
    </div>

    <script>
        // Set the donation date in Arabic format
        document.getElementById('donationDate').textContent = new Date().toLocaleDateString('ar-SA');
    </script>
</body>
</html>