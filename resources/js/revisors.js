require('./bootstrap');

Vue.component('works',              require('./components/revisors/Works.vue').default);
Vue.component('modal-evaluation',   require('./components/revisors/Evaluation.vue').default);

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