/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Custom error messages 
 */

window.showAxiosErrorMessage = (error) => {

    let errorMessage = `<p class="uk-margin-remove uk-text-break">${ error.response.data.message }</p>`;

    if (error.response.data.errors) {

        let listOfErrors = `<ul class="uk-margin-small">`;

        for (let field in error.response.data.errors) {
            if (error.response.data.errors.hasOwnProperty(field)) {
              listOfErrors += `<li>${error.response.data.errors[field]}</li>`;
            }
        }

        listOfErrors += `</ul>`;
        errorMessage += listOfErrors;
    }

    return UIkit.notification(errorMessage, 'danger');
}

/**
 * Delete preloader page with promise after loading animation
 */

function hidePreloaderPage () {
    return new Promise((resolve, reject) => {
        
        let preloaderPage = document.getElementById('preloader-page'); 

        preloaderPage.classList.add('uk-animation-fade', 'uk-animation-reverse');
    
        resolve(preloaderPage);
    });
}

window.addEventListener("load", function(event) {
    
    hidePreloaderPage()
        .then((preloaderPage) => {
            setTimeout( () =>  preloaderPage.setAttribute("hidden", true) , 400);
        });
});

/**
 * Load Vue.js and set route (ziggy) method in globals methods
 */

window.Vue = require('vue');

// Vue.config.devtools = false
// Vue.config.debug = false
// Vue.config.silent = true

Vue.mixin({
    methods: {
        route: route,
        getAvatar: function (avatar) {
            if (avatar && avatar.startsWith('https')) {
                return avatar;
            } else if (avatar && !avatar.startsWith('https')) {
                return avatar.replace('public','/storage');
            } else {
                return '/images/avatar.png';
            }
        }
    }
});

Vue.component('widget-notifications',   require('./components/users/WidgetNotification.vue').default);

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
