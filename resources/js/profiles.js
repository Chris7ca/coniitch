require('./bootstrap');

import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(VueContentPlaceholders)

Vue.component('personal-profile',       require('./components/users/PersonalProfile.vue').default);
Vue.component('academic-profile',       require('./components/congressman/AcademicProfile.vue').default);
Vue.component('professional-profile',   require('./components/congressman/ProfessionalProfile.vue').default);
Vue.component('invoicing-data',         require('./components/congressman/Invoicing.vue').default);
Vue.component('emergency-contact',      require('./components/congressman/EmergencyContact.vue').default);
Vue.component('password',               require('./components/users/Password.vue').default);
Vue.component('avatar',                 require('./components/users/Avatar.vue').default);

const app = new Vue({
    el: '#app'
});