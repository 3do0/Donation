<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Takaful</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        @font-face {
            font-family: 'Tajawal';
            src: url('assets/fonts/Tajawal-Regular.ttf') format('ttf');
        }

        body {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>

<body>
    <div class="floating-shapes">
        <div class="shape heart"><i class="bi bi-heart-fill"></i></div>
        <div class="shape hand"><i class="bi bi-hand-heart"></i></div>
        <div class="shape gift"><i class="bi bi-gift"></i></div>
        <div class="shape house"><i class="bi bi-house-heart"></i></div>
        <div class="shape star"><i class="bi bi-star-fill"></i></div>
    </div>

    <div class="gradient-bg">
        <div class="noise-overlay"></div>
        <div class="glow-effect"></div>
        <main class="content-wrapper">
            <div class="container">
                {{ $slot }}

            </div>
        </main>
    </div>

    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
