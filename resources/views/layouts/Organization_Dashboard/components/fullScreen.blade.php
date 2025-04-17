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