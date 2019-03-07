require('./bootstrap');

import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(VueContentPlaceholders);

Vue.component('records',                require('./components/finances/Records.vue').default);
Vue.component('modal-profile',          require('./components/users/ModalProfile.vue').default);

Vue.component('services',               require('./components/finances/Services.vue').default);
Vue.component('modal-service',          require('./components/finances/Service.vue').default);
Vue.component('modal-discount',         require('./components/finances/Discount.vue').default);

Vue.component('payments',               require('./components/finances/Payments.vue').default);
Vue.component('payment-information',    require('./components/finances/PaymentInformation.vue').default);

const app = new Vue({
    el: '#app'
});