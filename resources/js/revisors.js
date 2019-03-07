require('./bootstrap');

Vue.component('works',              require('./components/revisors/Works.vue').default);
Vue.component('modal-evaluation',   require('./components/revisors/Evaluation.vue').default);

const app = new Vue({
    el: '#app'
});