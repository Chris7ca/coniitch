window.Vue = require('vue');

const app = new Vue({
    el: '#form-auth',
    data: {
        password: '',
        passwordIsValid: null,
        passwordConfirmation: '',
        passwordConfirmationIsValid: null,
        regex: /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/
    },
    watch: {
        password: function (val) {
            this.passwordIsValid = (this.regex.test(val));
        },
        passwordConfirmation: function (val) {
            this.passwordConfirmationIsValid = (this.password === this.passwordConfirmation);
        }
    }
});
