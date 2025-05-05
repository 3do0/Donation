<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    
    Pusher.logToConsole = true;  

    var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        forceTLS: true
    });


    var channel = pusher.subscribe('notification');

    channel.bind('test.notification', function(data) {
        const msg = `${data.content}`;
        const title = `${data.title}`;

        console.log('Data received: ', data);  
        iziToast.info({
            title: title,
            message: msg,
            position: 'topCenter',   
            timeout: 30000,
            progressBar: true,
            close: true,
            rtl: true,
            transitionIn: 'fadeInUp', 
            transitionOut: 'fadeOutDown', 
        });
    });
</script>
