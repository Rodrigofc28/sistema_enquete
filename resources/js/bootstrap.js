/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
import Echo from 'laravel-echo';
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



window.Pusher = require('pusher-js');


window.Echo = new Echo({
    broadcaster: 'redis',
    key: process.env.MIX_PUSHER_APP_KEY,
    host: window.location.hostname + ':6001', // Porta padrão para o servidor Redis
});

window.Echo.channel('enquete-channel')
    .listen('enquete-status-updated', (event) => {
        // Atualize a interface do usuário com o novo status
        console.log('Enquete Status Updated:', event);
    });
