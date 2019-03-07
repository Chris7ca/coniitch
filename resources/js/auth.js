window.Vue = require('vue');

const app = new Vue({
    el: '#form-auth',
    data: {
        password: '',
        passwordIsValid: null,
        passwordConfirmation: '',
        passwordConfirmationIsValid: null,
        oneUppercaseLetter: /[A-Z]/,
        oneLowercaseLetter: /[a-z]/,
        oneNumber: /[0-9]/
    },
    watch: {
        password: function (val) {

            this.passwordIsValid = false;

            if ( val.length > 8 && this.oneLowercaseLetter.test(val) && this.oneUppercaseLetter.test(val) && this.oneNumber.test(val) ) {

                this.passwordIsValid = true;
            }
        },
        passwordConfirmation: function (val) {
            this.passwordConfirmationIsValid = (this.password === this.passwordConfirmation);
        }
    }
});
