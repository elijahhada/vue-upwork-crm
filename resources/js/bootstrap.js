window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// const fs = require('fs');
window.io = require('socket.io-client');
window.socket = io(`${window.location.hostname}:3000`, { transports: ['websocket'], rejectUnauthorized: false });
// window.socket = io(`${window.location.hostname}:3000`, { ca: [fs.readFileSync('')], rejectUnauthorized: false });
