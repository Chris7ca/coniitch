<template>
    
    <div>

        <p class="uk-text-meta">Completa tu información personal, es muy importante que conozcamos los siguientes datos.</p>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading/>
            <content-placeholders-text :lines="10" />
        </content-placeholders>

        <form @submit.prevent="handleSubmit" class="uk-grid uk-form-stacked uk-margin-medium-top" v-if="dataLoaded" uk-grid>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Primer Nombre</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="firstName" required placeholder="Requerido">
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Segundo Nombre</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="secondName" placeholder="Opcional">
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Primer Apellido</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="lastName" required placeholder="Requerido">
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Segundo Apellido</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="secondLastName" placeholder="Opcional">
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Correo electrónico</label>
                <div class="uk-form-controls">
                    <input type="email" class="uk-input" v-model="email" required placeholder="Requerido">
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Número de teléfono</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="phoneNumber" required placeholder="Requerido">
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Sexo</label>
                <div class="uk-form-controls">
                    <multiselect v-model="gender" :searchable="false" label="name" track-by="value" :options="genders" required placeholder="Selecciona una opción"></multiselect>
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Fecha de nacimiento</label>
                <div class="uk-form-controls">
                    <flat-pickr class="uk-input" v-model="birthdate" required placeholder="Requerido"></flat-pickr>
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">País</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="country" required placeholder="Requerido">
                </div>
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Estado</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="state" required placeholder="Requerido">
                </div>
            </div>
            <div class="uk-width-1-1">
                <button class="uk-button uk-button-default rounded-button" type="submit">Actualizar Información</button>
            </div>
        </form>
    </div>

</template>


<script>

    import Multiselect from 'vue-multiselect';
    import flatPickr from 'vue-flatpickr-component';  
    import 'flatpickr/dist/flatpickr.css';
    
    export default {

        components: {
            Multiselect,flatPickr
        },
        data() {
            return {
                dataLoaded: false,
                firstName: '',
                secondName: '',
                lastName: '',
                secondLastName: '',
                email: '',
                phoneNumber: '',
                gender: '',
                genders: [
                    { name: 'Hombre', value: 'Male' },
                    { name: 'Mujer', value: 'Female' }
                ],
                birthdate: '',
                country: '',
                state: ''
            }
        },
        methods: {
            getData: function() {
                return {
                    first_name: this.firstName,
                    second_name: this.secondName,
                    last_name: this.lastName,
                    second_last_name: this.secondLastName,
                    email: this.email,
                    phone_number: this.phoneNumber,
                    gender: this.gender.value,
                    birthdate: this.birthdate,
                    country: this.country,
                    state: this.state
                };
            },
            handleSubmit: function() {
                
                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.users.profile.personal.update'), data)
                .then( response => {
                    this.dataLoaded = true;
                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    UIkit.notification(error, 'danger');
                })
            }
        },
        created() {

            axios.post(route('app.users.profile.personal.edit'))
            .then( information => {

                let data =              information.data;
                this.firstName =        data.first_name;
                this.secondName =       (data.personal_profile) ? data.personal_profile.second_name : '';
                this.lastName =         data.last_name;
                this.secondLastName =   (data.personal_profile) ? data.personal_profile.second_last_name : '';
                this.email =            data.email;
                this.phoneNumber =      (data.personal_profile) ? data.personal_profile.phone_number : '';
                this.gender =           (data.personal_profile) ? this.genders.filter(g => g.value == data.personal_profile.gender)[0] : '';
                this.birthdate =        (data.personal_profile) ? data.personal_profile.birthdate : '';
                this.country =          (data.personal_profile) ? data.personal_profile.country : '';
                this.state =            (data.personal_profile) ? data.personal_profile.state : '';
                this.dataLoaded =       true;
            })
            .catch( error => {
                UIkit.notification(error, 'danger');
                this.dataLoaded = true;
            });    
        }

    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>