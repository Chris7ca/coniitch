require('./bootstrap');

Vue.component('cart',           require('./components/congressman/Cart.vue').default);
Vue.component('services',       require('./components/congressman/Services.vue').default);
Vue.component('upload-voucher', require('./components/congressman/UploadVoucher.vue').default);

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