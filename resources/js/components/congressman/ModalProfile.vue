<template>
    
    <div id="modal-profile" class="uk-modal-container uk-flex-top" uk-modal>

        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-padding-remove" style="border-radius: 0.25rem; overflow: hidden;">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <div class="uk-grid uk-grid-collapse uk-grid-match uk-child-width-1-2@m" uk-grid>

                <div>
                    <div class="uk-background-cover" data-src="/images/background-profile.jpg" uk-img>
                        
                        <div class="gradient-background-bottom uk-flex uk-flex-column uk-flex-between uk-height-1-1 uk-light uk-padding">
                            <div>
                                <h6>Información del usuario</h6>
                            </div>

                            <div class="uk-flex uk-flex-column uk-flex-middle uk-margin-medium-top">

                                <div class="avatar-container-light" style="width: 200px; height: 200px;">
                                    <img :data-src="avatar" uk-img>
                                </div>

                                <h5 class="uk-margin-small" v-if="dataLoaded">{{ fullName }}</h5>
                                <hr class="uk-divider-small uk-margin-small">

                                <p class="uk-margin-small uk-text-center" v-if="dataLoaded">
                                    {{ methodToRegister }}
                                </p>

                            </div>

                            <div class="uk-text-center uk-margin-medium-top">
                                <p v-if="dataLoaded"><span uk-icon="mail"></span> / {{ profile.email }}</p>
                                <p v-if="dataLoaded"><span uk-icon="receiver"></span> / {{ profile.personal_profile.phone_number }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div>
                    <div class="uk-flex uk-flex-middle uk-padding">
                        <div>
                            <h4>Datos personales</h4>
                            <hr class="uk-divider-small">
                            <ul v-if="dataLoaded">
                                <li><b>Sexo:</b> {{ (profile.personal_profile.gender == 'Male') ? 'Masculino' : 'Femenino' }}</li>
                                <li><b>Edad:</b> {{ profile.personal_profile.age }}</li>
                                <li><b>Originario:</b> {{ profile.personal_profile.state + ', ' + profile.personal_profile.country  }}</li>
                            </ul>

                            <content-placeholders v-if="!dataLoaded">
                                <content-placeholders-text :lines="3" />
                            </content-placeholders>

                            <h4>Información académica</h4>
                            <hr class="uk-divider-small">
                            <ul v-if="profile.academic_profile != null && dataLoaded">
                                <li><b>Carrera:</b> {{ profile.academic_profile.career }}</li>
                                <li><b>Universidad / Instituto:</b> {{ profile.academic_profile.institute + ', ' + profile.academic_profile.faculty }}</li>
                                <li><b>País:</b> {{ profile.academic_profile.state + ', ' + profile.academic_profile.country }}</li>
                            </ul>

                            <content-placeholders v-if="!dataLoaded">
                                <content-placeholders-text :lines="3" />
                            </content-placeholders>

                            <p v-if="dataLoaded && profile.academic_profile == null">No ha registrado información académica.</p>

                            <h4>Información profesional</h4>
                            <hr class="uk-divider-small">
                            <ul v-if="profile.professional_profile != null && dataLoaded">
                                <li><b>Trabajo actual:</b> {{ profile.professional_profile.job_title }}</li>
                                <li><b>Lugar de trabajo:</b> {{ profile.professional_profile.institute }}</li>
                                <li><b>País:</b> {{ profile.professional_profile.state + ', ' + profile.professional_profile.country }}</li>
                            </ul>

                            <content-placeholders v-if="!dataLoaded">
                                <content-placeholders-text :lines="3" />
                            </content-placeholders>  

                            <p v-if="dataLoaded && profile.professional_profile == null">No ha registrado información profesional.</p>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

</template>


<script>
    
    import { EventBus } from  './../../bus.js';

    export default {

        data() {
            return {
                dataLoaded: false,
                profile: {}
            }
        },
        computed: {
            fullName: function () {

                let firstName = this.profile.first_name;
                let secondName = (this.profile.personal_profile.second_name) ? this.profile.personal_profile.second_name : '';
                let lastName = this.profile.last_name;
                let secondLastName = (this.profile.personal_profile.second_last_name) ? this.profile.personal_profile.second_last_name : '';

                return firstName + ' ' + secondName + ' ' + lastName + ' ' + secondLastName;
            },
            avatar: function () {
                
                if ( this.profile.avatar && this.profile.avatar.startsWith('https') ) {
                    return this.profile.avatar;
                } else if ( this.profile.avatar && !this.profile.avatar.startsWith('https') ) {
                    return this.profile.avatar.replace('public','/storage');
                } else {
                    return '/images/avatar.png';
                }
            },
            methodToRegister: function () {

                let text;
                
                switch (this.profile.method_to_register) {
                    case 'Traditional':
                        text = `${this.profile.first_name} ${this.profile.last_name} realizó su registro en la plataforma y lo hizo de forma tradicional.`;
                        break;

                    case 'Facebook':
                        text = `${this.profile.first_name} ${this.profile.last_name} realizó su registro en la plataforma y utilizó su cuenta de Facebook para registrarse.`;
                        break;

                    case 'Google':
                        text = `${this.profile.first_name} ${this.profile.last_name} realizó su registro en la plataforma y utilizó su cuenta de Google para registrarse.`;
                        break;
                
                    default:
                        text = 'Usuario con privilegios.'
                        break;
                }

                return text;
            }
        },
        created() {
         
            EventBus.$on('showProfile', (id) => {

                this.dataLoaded = false;

                axios.post(route('app.profiles.show', { id : id }))
                .then( response => {
                    this.dataLoaded = true;
                    this.profile = response.data.profile;
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }); 
        }

    }

</script>