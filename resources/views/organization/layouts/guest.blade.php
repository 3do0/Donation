<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/logo.jpg') }}" type="image/jpg">

    <title>Takaful</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link id="theme-css" rel="stylesheet" href="{{ asset('assets/css/dark.css') }}">
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">

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

<body class="form">
    <div class="form-container">
        {{ $slot }}
    </div>

<script src="{{ asset('assets/js/auth.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
