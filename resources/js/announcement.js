require('./bootstrap');

Vue.component('work',      require('./components/congressman/Work.vue').default);

const app = new Vue({
    el: '#app'
});