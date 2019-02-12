require('./bootstrap');

import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(VueContentPlaceholders)

Vue.component('criteria',           require('./components/admin/Criteria.vue').default);
Vue.component('criterias',          require('./components/admin/Criterias.vue').default);

Vue.component('works',              require('./components/admin/Works.vue').default);
Vue.component('assign-revisors',    require('./components/admin/AssignRevisors.vue').default);
Vue.component('modal-reviews',      require('./components/admin/ModalReviews.vue').default);

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