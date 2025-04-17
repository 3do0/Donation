<script>
        window.addEventListener('swal:toast', function (event) {
            const data = event.detail[0];
            const { icon, title, timer = 3000, position = 'top-start' } = data;

            const Toast = Swal.mixin({
                toast: true,
                position: position,
                showConfirmButton: false,
                timer: timer,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: icon || 'info',
                title: title || ''
            });
        });
</script>