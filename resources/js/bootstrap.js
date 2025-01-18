import "bootstrap";

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import Echo from "laravel-echo";
window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

// import Echo from "laravel-echo";
// import Pusher from "pusher-js";

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '2de0610b1c42b335a6df',
//     cluster: 'ap2',
//     encrypted: true
// });

// // Listen for the ResponseCreated event
// window.Echo.channel("response-channel").listen("ResponseCreated", (event) => {
//     // Add the new response to the list dynamically
//     const responseList = document.getElementById("responseList");
//     const newResponse = document.createElement("li");
//     newResponse.innerHTML = `${event.message} - <small>${event.created_at}</small>`;
//     responseList.appendChild(newResponse);
// });

// // Handle the form submission
// document
//     .getElementById("responseForm")
//     .addEventListener("submit", function (e) {
//         e.preventDefault();

//         let response = document.querySelector(
//             'textarea[name="response"]'
//         ).value;

//         axios
//             .post('{{ route("responses.store") }}', {
//                 response: response,
//             })
//             .then((response) => {
//                 document.querySelector('textarea[name="response"]').value = ""; // Clear textarea
//             })
//             .catch((error) => {
//                 console.log(error);
//             });
//     });

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import "./echo";
