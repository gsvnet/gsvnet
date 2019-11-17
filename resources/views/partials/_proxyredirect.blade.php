<script>
    (function() {
        // Make sure we are visiting GSVnet directly, not via a webproxy
        // Relates to the gsvg.nl shenanigans by the VGST
        var host = '{{ request()->getHost() }}';
        console.log(host, window.location.hostname);
        /*if(host != window.location.hostname) {
            window.location = host + window.location.pathname
        }*/
    })()
</script>