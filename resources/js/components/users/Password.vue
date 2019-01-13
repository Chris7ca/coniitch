<template>

    <div>

        <p class="uk-text-muted">En en caso de querer cambiar tu contraseña, llena el siguiente formulario.</p>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading/>
            <content-placeholders-text :lines="2"/>
        </content-placeholders>

        <form @submit.prevent="handleSubmit" v-if="dataLoaded" class="uk-grid uk-child-width-2-3@m uk-form-stacked uk-margin-medium-top" uk-grid>
            <div class="uk-margin">
                <label class="uk-form-label">Nueva contraseña</label>
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip uk-text-warning" uk-icon="icon: warning" v-if="passwordIsValid == false"></span>
                    <span class="uk-form-icon uk-form-icon-flip uk-text-primary" uk-icon="icon: check" v-if="passwordIsValid == true"></span>
                    <input type="password" class="uk-input" v-model="password" required placeholder="*******************">
                </div>
                <span class="uk-text-warning uk-text-bold" v-if="passwordIsValid == false">
                    <small>La contraseña debe de tener mínimo 8 caracteres, una letra mayúscula, una letra minúscula y un dígito</small>
                </span>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Repíta su contraseña</label>
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip uk-text-warning" uk-icon="icon: warning" v-if="passwordConfirmationIsValid == false"></span>
                    <span class="uk-form-icon uk-form-icon-flip uk-text-primary" uk-icon="icon: check" v-if="passwordConfirmationIsValid == true"></span>
                    <input type="password" class="uk-input" v-model="passwordConfirmation" required placeholder="*******************">
                </div>
                <span class="uk-text-warning uk-text-bold" v-if="passwordConfirmationIsValid == false">
                    <small>Las contraseñas no coinciden</small>
                </span>
            </div>
            <div class="uk-width-1-1">
                <button class="uk-button uk-button-default rounded-button" :disabled="password != passwordConfirmation">Actualizar contraseña</button>    
            </div>   
        </form>   

    </div> 

</template>

<script>
    
    export default {

        data() {
            return {
                dataLoaded: true,
                password: '',
                passwordIsValid: null,
                passwordConfirmation: '',
                passwordConfirmationIsValid: null,
                regex: /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/
            }
        },
        watch: {
            password: function (val) {
                this.passwordIsValid = (this.regex.test(val));
            },
            passwordConfirmation: function (val) {
                this.passwordConfirmationIsValid = (this.password === this.passwordConfirmation);
            }
        },
        methods: {
            getData: function() {
                return {
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                }
            },
            handleSubmit: function() {

                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.user.password.update'), data)
                .then( response => {
                    this.dataLoaded = true;
                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }
        }

    }

</script>