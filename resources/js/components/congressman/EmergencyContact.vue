<template>

    <div>

        <p class="uk-text-meta"><b>Información importante.</b> Requerimos contar con un contacto de emergencia en caso de que requieras asistencia médica durante el congreso.</p>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading/>
            <content-placeholders-text :lines="4"/>
        </content-placeholders>

        <form @submit.prevent="handleSubmit" v-if="dataLoaded" class="uk-grid uk-form-stacked uk-margin-medium-top" uk-grid>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Relación/Parentezco</label>
                <input type="text" class="uk-input" v-model="relationship" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Nombre Completo</label>
                <input type="text" class="uk-input" v-model="fullName" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Telefóno Móvil</label>
                <input type="text" class="uk-input" v-model="firstPhoneNumber" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Teléfono Fíjo</label>
                <input type="text" class="uk-input" v-model="secondPhoneNumber" required placeholder="Opcional">
            </div>
            <div class="uk-width-1-1">
                <button class="uk-button uk-button-default rounded-button" type="submit">Actualizar Información</button>
            </div>
        </form>

    </div>
    
</template>

<script>
    
    export default {
        data() {
            return {
                dataLoaded: false,
                relationship: '',
                fullName: '',
                firstPhoneNumber: '',
                secondPhoneNumber: ''
            }
        },
        methods: {
            getData: function() {
                return {
                    relationship:  this.relationship,
                    full_name: this.fullName,
                    first_phone_number: this.firstPhoneNumber,
                    second_phone_number: this.secondPhoneNumber,
                }
            },
            handleSubmit: function() {

                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.emergency.contact.update'), data)
                .then( response => {
                    this.dataLoaded = true;
                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created() {

            axios.post(route('app.emergency.contact.edit'))
            .then( information => {
                let data = information.data;
                this.relationship = (data.emergency_contact) ? data.emergency_contact.relationship : ''; 
                this.fullName = (data.emergency_contact) ? data.emergency_contact.full_name : ''; 
                this.firstPhoneNumber = (data.emergency_contact) ? data.emergency_contact.first_phone_number : ''; 
                this.secondPhoneNumber = (data.emergency_contact) ? data.emergency_contact.second_phone_number : ''; 
                this.dataLoaded = true;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });   
        }
    }

</script>