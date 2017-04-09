// Laravel Echo setup for WebSockets
import Echo from "laravel-echo";

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'local-test-key',
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
    forceTLS: false
});

window.Echo.channel('orders')
    .listen('OrderPlacedEvent', (e) => {
        console.log('Realtime order arrived:', e);
    });
