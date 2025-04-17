<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مرحبًا بعودتكم</title>
    <link rel="stylesheet" href="{{ asset('assets/css/welcome-page.css') }}">
</head>
<body>
    <div class="gradient-bg">
        <div class="noise-overlay"></div>
        <div class="glow-effect"></div>
        <main class="content-wrapper">
            <div class="container">
                <div class="welcome-content text-center">
                    <h1 class="welcome-text">مرحباً بك في تـكـافـل</h1>
                    <p class="welcome-description">أختر نوع تسجيل الدخول للوصول الى لوحة التحكم</p>
                    <div class="action-buttons">
                        <a type="button" class="btn btn-glow" href="{{route('login')}}">مشرف</a>
                        <a type="button" class="btn btn-outline" href="{{route('organization.login')}}">منظمة</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>