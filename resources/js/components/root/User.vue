<template>

    <div>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading />
            <content-placeholders-text :lines="10"/>
        </content-placeholders>

        <div v-if="dataLoaded">
            
            <h4>Crear o editar usuarios</h4>
            <hr class="uk-divider-small">

            <form @submit.prevent="handleSubmit" class="uk-form-stacked">
                <div class="uk-margin">
                    <label class="uk-form-label">Primer Nombre</label>
                    <input type="text" class="uk-input" v-model="firstName" required placeholder="Requerido...">
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Primer Apellido</label>
                    <input type="text" class="uk-input" v-model="lastName" required placeholder="Requerido...">
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Correo electrónico</label>
                    <input type="email" class="uk-input" v-model="email" required placeholder="Requerido...">
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Roles</label>
                    <div class="uk-form-controls">
                        <multiselect v-model="selectedRoles" :multiple="true" :searchable="false" label="name" track-by="value" :options="roles" required placeholder="Selecciona los roles"></multiselect>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Nueva contraseña</label>
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip uk-text-warning" uk-icon="icon: warning" v-if="passwordIsValid == false"></span>
                        <span class="uk-form-icon uk-form-icon-flip uk-text-primary" uk-icon="icon: check" v-if="passwordIsValid == true"></span>
                        <input type="password" class="uk-input" v-model="password" :required="mode == 'create'" placeholder="*******************">
                    </div>
                    <span class="uk-text-warning uk-text-bold" v-if="passwordIsValid == false">
                        <small>La contraseña debe de tener mínimo 8 caracteres, una letra mayúscula, una letra minúscula y un dígito</small>
                    </span>
                </div>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary rounded-button" type="submit">{{ textButtonSubmit }}</button>
                </div>
            </form>

        </div>
    
    </div>

</template>


<script>
    
    import { EventBus } from './../../bus.js';
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            Multiselect
        },
        data() {
            return {
                mode: 'create',
                dataLoaded: true,
                roles: [],
                publicId: '',
                indexUser: '',
                firstName: '',
                lastName: '',
                email: '',
                selectedRoles: [],
                password: '',
                passwordIsValid: null,
                regex: /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/
            }
        },
        watch: {
            password: function (val) {
                this.passwordIsValid = (this.regex.test(val));
            }
        },
        computed: {
            textButtonSubmit: function() {
                return (this.mode == 'create') ? 'Crear usuario' : 'Actualizar usuario';
            }
        },
        methods: {
            getData: function() {

                let finallyRoles = [];
                this.selectedRoles.forEach( role => finallyRoles.push(role.value) );

                return {
                    first_name: this.firstName,
                    last_name: this.lastName,
                    email: this.email,
                    password: this.password,
                    roles: finallyRoles
                }
            },
            handleSubmit: function() {

                let data = this.getData();
                this.dataLoaded = false;

                if (this.mode == 'create') {
                    this.storeUser(data);
                } else {
                    this.updateUser(data);
                }
            },
            storeUser: function(data) {
                
                axios.post(route('app.users.store'), data)
                .then( response => {
                    this.dataLoaded = true;
                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            },
            updateUser: function(data) {

                let url = route('app.users.update', { id : this.publicId });

                axios.post(url, data)
                .then( user => {
                    this.dataLoaded = true;
                    EventBus.$emit('userUpdated', user.data);
                    UIkit.notification('Usuario actualizado','success');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created() {
            
            axios.post(route('app.roles.simple.search'))
            .then( roles => {
                roles.data.forEach(role => {
                    this.roles.push({ name: role.display_name, value: role.public_id });
                });
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('editUser', (url) => {

                this.dataLoaded = false;

                axios.post(url)
                .then( user => {
                    this.mode = 'update';
                    this.dataLoaded = true;
                    this.firstName = user.data.first_name;
                    this.lastName = user.data.last_name;
                    this.email = user.data.email;
                    this.publicId = user.data.public_id;
                    this.selectedRoles = [];
                    user.data.roles.forEach( role => {
                        this.selectedRoles.push(this.roles.filter( r => r.value == role.public_id)[0]);
                    });
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                }); 
            });
        }
    }
    
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>