<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $PageTitle ?? 'الرئيسية' }}</title>

        {{-- <link rel="icon" type="image/png" href="../assets/img/favicon.png" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/organization/main.css?v=1.0.0') }}" rel="stylesheet" />
        <link id="pagestyle" href="{{ asset('assets/css/organization/components/profile-card.css') }}" rel="stylesheet" />

        <style>
          @font-face {
              font-family: 'Tajawal';
              src: url('assets/fonts/Tajawal-Regular.ttf') format('ttf');
          }
    
          body {
              font-family: 'Tajawal', sans-serif; /* تطبيق الخط الجديد على كل الصفحة */
          }
          
          
          </style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite(['resources/js/app.js'])
    @livewireStyles
    </head>
    <body class="g-sidenav-show rtl bg-gray-100">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.Organization_Dashboard.navigation')

            
            <!-- Page Content -->
            <main class="main-content position-relative border-radius-lg ">
                <!-- Page Heading -->
                @include('layouts.Organization_Dashboard.header')
                {{ $slot }}
            </main>
        </div>

            <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/organization/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/organization/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/organization/corporate-ui-dashboard.min.js?v=1.0.0') }}"></script>


    @yield('js')

    @include('layouts.Organization_Dashboard.components.fullScreen')
    @include('layouts.Organization_Dashboard.components.modalDelete')

    @include('layouts.components.modalInfo')
    @include('layouts.components.modalDeleteConfirm')
    @livewireScripts
<script>
  window.addEventListener('change-page-title', event => {
      document.title = event.detail.title;
  });
</script>

    </body>
</html>
