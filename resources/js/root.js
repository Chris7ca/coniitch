require('./bootstrap');

import Qriously from 'vue-qriously';
import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(VueContentPlaceholders);
Vue.use(Qriously);

Vue.component('users',              require('./components/root/Users.vue').default);
Vue.component('user',               require('./components/root/User.vue').default);
Vue.component('users-statistics',   require('./components/root/UsersStatistics.vue').default);
Vue.component('modal-profile',      require('./components/users/ModalProfile.vue').default);

Vue.component('modal-documents',    require('./components/root/Documents.vue').default);
Vue.component('modal-document',     require('./components/root/Document.vue').default);

Vue.component('roles',              require('./components/root/Roles.vue').default);
Vue.component('role',               require('./components/root/Role.vue').default);

Vue.component('events',             require('./components/root/Events.vue').default);
Vue.component('modal-event',        require('./components/root/Event.vue').default);
Vue.component('attendances',        require('./components/root/Attendances.vue').default);

Vue.component('modal-qr-code',      require('./components/helpers/QRCodeGenerator.vue').default);

const app = new Vue({
    el: '#app'
});