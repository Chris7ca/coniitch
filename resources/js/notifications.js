require('./bootstrap');

Vue.component('notifications',  require('./components/helpers/Notifications.vue').default);

const app = new Vue({
    el: '#app',
    methods:{
        logout: function() {
            axios.post(route('logout'))
            .then( response => {
                window.location = route('site.login');
            })
            .catch( error => {
                console.log(error);
            });
        }
    }
});