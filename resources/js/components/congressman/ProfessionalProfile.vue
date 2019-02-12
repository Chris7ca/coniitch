<template>

    <div>

        <p class="uk-text-meta"><b>NOTA.</b> Este pefil no es requerido, solo en caso de que actualmente te encuentres trabajando, puedes completar la siguiente información.</p>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading/>
            <content-placeholders-text :lines="5"/>
        </content-placeholders>

        <form @submit.prevent="handleSubmit" v-if="dataLoaded" class="uk-grid uk-form-stacked uk-margin-medium-top" uk-grid>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Puesto</label>
                <input type="text" class="uk-input" v-model="jobTitle" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Empresa/Institución</label>
                <input type="text" class="uk-input" v-model="institute"  required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">País</label>
                <input type="text" class="uk-input" v-model="country" required placeholder="Requerido">
            </div>
            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Estado</label>
                <input type="text" class="uk-input" v-model="state" required placeholder="Requerido">
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
                jobTitle: '',
                institute: '',
                country: '',
                state: ''
            }
        },
        methods: {
            getData: function() {
                return {
                    job_title: this.jobTitle,
                    institute: this.institute,
                    country: this.country,
                    state: this.state,
                }
            },
            handleSubmit: function() {

                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.profiles.professional.update', data))
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

            axios.post(route('app.profiles.professional.edit'))
            .then( information => {
                let data =          information.data;
                this.jobTitle =     (data.professional_profile) ? data.professional_profile.job_title : '';
                this.institute =    (data.professional_profile) ? data.professional_profile.institute : '';
                this.country =      (data.professional_profile) ? data.professional_profile.country : '';
                this.state =        (data.professional_profile) ? data.professional_profile.state : '';
                this.dataLoaded =   true;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });
        }
    }

</script>