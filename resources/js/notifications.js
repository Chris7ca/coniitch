require('./bootstrap');

Vue.component('notifications',  require('./components/users/Notifications.vue').default);

const app = new Vue({
    el: '#app'
});