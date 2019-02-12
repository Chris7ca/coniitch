<template>

    <div>

        <p class="uk-text-meta">Grado actual o último grado de estudios.</p>
        <p class="uk-text-meta"><b>NOTA:</b> Si actualmente estas estudiando y acretidas tu estatus académico con algun documento (creadencial vigente, 
        historial académico, constancia, etc.) recibirás un descuento al momento de realizar tu pago para asistir al congreso. Una vez que adjuntes 
        el documento escanedo se realizará la verificación del mismo y te notificaremos si se te otorgará dicho descuento.</p>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading/>
            <content-placeholders-text :lines="5"/>
        </content-placeholders>

        <form @submit.prevent="handleSubmit" class="uk-grid uk-form-stacked uk-margin-medium-top" v-if="dataLoaded" uk-grid>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Título/Carrera</label>
                <input type="text" class="uk-input" v-model="career" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Universidad/Instituto</label>
                <input type="text" class="uk-input" v-model="institute" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Facultad</label>
                <input type="text" class="uk-input" v-model="faculty" required placeholder="Opcional">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">País</label>
                <input type="text" class="uk-input" v-model="country" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Estado</label>
                <input type="text" class="uk-input" v-model="state" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Estatus académico 
                    <span class="uk-margin-small-left" uk-tooltip="En cualquier momento puedes adjuntar el documento escanedo. Solo asegúrate hacerlo antes de realizar el pago para que se pueda validar tu información." uk-icon="question"></span>
                </label>
                <div class="uk-width-1-1" uk-form-custom="target: true">
                    <input type="file" ref="document" accept="application/pdf" v-if="document == null">
                    <input class="uk-input" type="text" :placeholder="hasAttachDocument" disabled>
                </div>
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
                career: '',
                institute: '',
                faculty: '',
                country: '',
                state: '',
                document: null
            }
        },
        computed: {
            hasAttachDocument: function () {
                return (this.document !=  null) ? 'Ya has adjuntado un documento' : 'Aún no adjuntas ningun documento'; 
            }
        },
        methods: {
            getData: function() {

                let formData  = new FormData();

                formData.append('career', this.career);
                formData.append('institute', this.institute);
                formData.append('faculty', this.faculty);
                formData.append('country', this.country);
                formData.append('state', this.state);
                formData.append('document', (this.$refs.document && this.$refs.document.files[0] != undefined)
                    ? this.$refs.document.files[0] : '');
                
                return formData;
            },
            handleSubmit: function() {

                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.profiles.academic.update'), data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
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
            axios.post(route('app.profiles.academic.edit'))
            .then( information => {
                let data =          information.data;
                this.career =       (data.academic_profile) ? data.academic_profile.career : '';
                this.institute =    (data.academic_profile) ? data.academic_profile.institute : '';
                this.faculty =      (data.academic_profile) ? data.academic_profile.faculty : '';
                this.country =      (data.academic_profile) ? data.academic_profile.country : '';
                this.state =        (data.academic_profile) ? data.academic_profile.state : '';
                this.document =     (data.academic_profile) ? data.academic_profile.document : null;
                this.dataLoaded =   true;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });
        }
    }

</script>