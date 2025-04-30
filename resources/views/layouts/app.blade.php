<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">

    <title>@yield('title','Takaful')</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/profile-card.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/components/page-title.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/components/card.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/users/account-setting.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @php
        $theme = session('theme', 'dark');
    @endphp
    <link id="theme-css" rel="stylesheet" href="{{ asset('assets/css/' . $theme . '.css') }}">
    
    <style>
        @font-face {
            font-family: 'Tajawal';
            src: url('assets/fonts/Tajawal-Regular.ttf') format('ttf');
        }

        body {
            font-family: 'Tajawal', sans-serif;
        }
    </style>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    @yield('PageCss')
    <!-- END PAGE LEVEL CUSTOM STYLES -->



</head>

<body class="alt-menu sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
    @include('layouts.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('layouts.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>الرئيسية</h3>
                    </div>
                </div>
                <hr>

                <!-- CONTENT AREA -->

                {{ $slot }}

                <!-- CONTENT AREA -->

            </div>
        </div>

        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/js/users/account-settings.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/dropify.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>

    

    <script>
        function toggleFullscreen() {
            if (!document.fullscreenElement && 
                !document.mozFullScreenElement && // Firefox
                !document.webkitFullscreenElement && // Safari و Chrome
                !document.msFullscreenElement) { // IE/Edge
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari, Opera
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
                    document.documentElement.msRequestFullscreen();
                }
                document.getElementById("fullscreen-icon").classList.remove("bi-arrows-fullscreen");
                document.getElementById("fullscreen-icon").classList.add("bi-x-square");
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { // Firefox
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { // Safari و Chrome
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { 
                    document.msExitFullscreen();
                }
                document.getElementById("fullscreen-icon").classList.remove("bi-x-square");
                document.getElementById("fullscreen-icon").classList.add("bi-arrows-fullscreen");
            }
        }
    </script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->

    {{-- ############################################ --}}

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/plugins/table/datatable/datatables.js') }}"></script>

    <script src="{{ asset('assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
    <script src="{{ asset('assets/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/js/invoice.js') }}"></script>
    @stack('scripts')
    @yield('PageJavaScribt')
    @include('layouts.components.modalInfo')
    @include('layouts.components.modalDeleteConfirm')
    @include('layouts.components.pusherNotification1')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>
