require('./bootstrap.js');

import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(VueContentPlaceholders);

Vue.component('sponsors',           require('./components/publicrelations/Sponsors.vue').default);
Vue.component('modal-sponsor',      require('./components/publicrelations/Sponsor.vue').default);

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