require('./bootstrap');

import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(VueContentPlaceholders);

Vue.component('roles',  require('./components/root/Roles.vue').default);
Vue.component('role',   require('./components/root/Role.vue').default);

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