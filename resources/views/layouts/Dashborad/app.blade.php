<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="../assets/img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>{{ $pageTitle ?? 'الرئيسية' }}</title>

    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
    
    <style>
      @font-face {
          font-family: 'Tajawal';
          src: url('assets/fonts/Tajawal-Regular.ttf') format('ttf');
      }

      body {
          font-family: 'Tajawal', sans-serif; /* تطبيق الخط الجديد على كل الصفحة */
      }


  </style>

@livewireStyles

  </head>

  <body class="g-sidenav-show rtl bg-gray-100">
   
    @include('layouts.Dashborad.aside')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
      @include('layouts.Dashborad.header')
      @livewire('main')
      
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>

@yield('js')
    
    <script>
      function toggleFullscreen() {
            if (!document.fullscreenElement && // إذا لم تكن الصفحة في وضع ملء الشاشة
                !document.mozFullScreenElement && // Firefox
                !document.webkitFullscreenElement && // Safari و Chrome
                !document.msFullscreenElement) { // IE/Edge
                // فتح الصفحة في ملء الشاشة
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari, Opera
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
                    document.documentElement.msRequestFullscreen();
                }
                // تغيير الأيقونة إلى الخروج من ملء الشاشة
                document.getElementById("fullscreen-icon").classList.remove("bi-arrows-fullscreen");
                document.getElementById("fullscreen-icon").classList.add("bi-x-square");
            } else {
                // الخروج من وضع ملء الشاشة
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { // Firefox
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { // Safari و Chrome
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
                // تغيير الأيقونة إلى ملء الشاشة مرة أخرى
                document.getElementById("fullscreen-icon").classList.remove("bi-x-square");
                document.getElementById("fullscreen-icon").classList.add("bi-arrows-fullscreen");
            }
        }
      
  </script>


<script>
  window.addEventListener('change-page-title', event => {
      document.title = event.detail.title;
  });
</script>

    @livewireScripts
  </body>
</html>