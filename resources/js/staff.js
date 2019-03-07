require('./bootstrap.js');

Vue.component('attendances',    require('./components/staff/Attendances.vue').default);

const app = new Vue({
    el: '#app'
});