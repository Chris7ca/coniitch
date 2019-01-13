require('./bootstrap');

import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(VueContentPlaceholders);

Vue.component('users',              require('./components/root/Users.vue').default);
Vue.component('user',               require('./components/root/User.vue').default);
Vue.component('users-statistics',   require('./components/root/UsersStatistics.vue').default);
Vue.component('modal-profile',      require('./components/congressman/ModalProfile.vue').default);

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