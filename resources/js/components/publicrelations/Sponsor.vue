<template>

    <div id="modal-sponsor" class="uk-modal-container uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-position-relative" style="border-radius: 0.25rem;">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h4>Formualrio para crear o editar patrocinadores</h4>
            <hr class="uk-divider-small">

            <div class="uk-grid uk-grid-large uk-flex-middle" uk-grid>

                <div class="uk-width-auto@m uk-flex uk-flex-column uk-flex-center uk-text-center">

                    <div class="uk-placeholder" style="min-height: 100px; width: 300px;">
                        <img :src="image" v-if="imageLoaded">
                        <img src="/svg/spinner.svg" v-else>
                    </div>

                    <span v-if="errorFile" class="uk-text-danger uk-text-small uk-margin">{{ textErrorFile }}</span>

                </div>

                <div class="uk-width-expand@m">

                    <form @submit.prevent="handleSubmit" class="uk-form-stacked">

                        <div class="uk-margin">
                            <label class="uk-form-label">Nombre del patrocinador</label>
                            <input type="text" class="uk-input" v-model="displayName" required>
                        </div>
        
                        <div class="uk-margin">
                            <label class="uk-form-label">URL (si aplica)</label>
                            <input type="text" class="uk-input" v-model="url"  :required="description == ''">
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Descripción (si aplica)</label>
                            <editor :id="'editor_sponsor'" v-model="description" :value="''"></editor>
                        </div>

                        <div class="uk-margin">
                            <label for="image-sponsor"><span class="uk-margin-small-right uk-margin-remove-top" uk-icon="image"></span> Cambiar imagen del patrocinador</label>
                            <input type="file" id="image-sponsor" @change="changeImage" accept="image/png" hidden>
                        </div>

                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit">{{ textBtnSubmit }}</button>
                        </div>
        
                    </form>

                </div>

            </div>

            <div class="uk-overlay-default uk-position-cover uk-flex uk-flex-center uk-flex-middle" v-if="!dataLoaded">
                <div uk-spinner></div>
            </div>

        </div>
    </div>
    
</template>


<script>
    
    import { EventBus } from './../../bus.js';
    import Editor from './../helpers/Editor.vue';

    export default {
        
        components: {
            Editor
        },
        data () {
            return {
                dataLoaded: true,
                mode: 'create',
                id: '',
                image: '/images/placeholder.jpg',
                imageLoaded: true,
                errorFile: false,
                textErrorFile: '',
                displayName: '',
                url: '',
                description: '',
            }
        },
        computed: {
            textBtnSubmit: function () {
                return (this.mode == 'create') ? 'Crear nuevo patrocinador' : 'Actualizar información';
            }
        },
        methods: {
            changeImage: function (event) {

                let file = event.target.files[0];
                let ext = this.getExtension(file.name);
                let size = file.size;
                let maxSize = 4194304; // bytes
                this.errorFile = '';

                if (ext == 'png' && size <= maxSize){

                    let reader = new FileReader();
                    this.imageLoaded = false;

                    reader.onload = (e) => {
                        this.image = e.target.result;
                        this.imageLoaded = true;
                    }

                    reader.readAsDataURL(file);

                } else{

                    event.target.files[0].value = null;
                    this.errorFile = true;
                    this.textErrorFile = (size > maxSize) ? 'La imagen excede los 4 MB' : 'Formato de imagen no admitido. Por favor, selecciona una imagen PNG';
                }
            },
            getExtension: function (path) {
                
                let basename = path.split(/[\\/]/).pop();
                let pos = basename.lastIndexOf('.');

                if (basename === '' || pos < 1) {
                    return '';
                }
                return basename.slice(pos + 1);
            },
            clearData: function () {
                this.image = '/images/placeholder.jpg';
                this.url = '';
                this.description = '';
                this.displayName = '';
            },
            getData: function () {

                let formData =  new FormData();
                let image = (document.getElementById('image-sponsor').files[0]) 
                    ? document.getElementById('image-sponsor').files[0] :  '';

                formData.append('display_name', this.displayName);
                formData.append('url', this.url);
                formData.append('description', this.description);
                formData.append('image', image);

                return formData;
            },
            handleSubmit: function () {

                if ( this.url != '' && this.description != '' ) {

                    UIkit.notification('El campo URL y descripción no pueden contener información al mismo tiempo, debes de elegir solo uno de ellos', 'warning');

                } else if ( this.mode == 'create' && !document.getElementById('image-sponsor').files ) {

                    UIkit.notification('Debes cargar una imagen del patricinador', 'warning');

                } else {
                    ( this.mode == 'create' ) ? this.storeSponsor() : this.updateSponsor(); 
                }

            },
            storeSponsor: function () {

                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.sponsors.store'), data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response => {
                    this.dataLoaded = true;
                    UIkit.modal('#modal-sponsor').hide();
                    UIkit.notification('Se creo un nuevo patrocinador', 'success');
                    EventBus.$emit('wasCreatedNewSponsor', response.data);
                })
                .catch( error => {
                    showAxiosErrorMessage(error);
                    this.dataLoaded = true;
                });

            },
            updateSponsor: function () {
                
                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.sponsors.update', { id : this.id }), data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response => {
                    this.dataLoaded = true;
                    UIkit.modal('#modal-sponsor').hide();
                    UIkit.notification('Se actualizó la información del patrocinador', 'success');
                    EventBus.$emit('wasUpdatedSponsor', response.data);
                })
                .catch( error => {
                    showAxiosErrorMessage(error);
                    this.dataLoaded = true;
                });
            }
        },
        created () {
            
            EventBus.$on('editSponsor', url => {

                this.dataLoaded = false;
                this.mode = 'update';

                axios.post(url)
                .then( response => {
                    this.dataLoaded = true;
                    this.id = response.data.public_id;
                    this.displayName = response.data.display_name;
                    this.url = (response.data.url != null) ? response.data.url : '';
                    this.description = (response.data.description != null) ? response.data.description : '';
                    this.image = response.data.image.replace('public', '/storage');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });

                UIkit.util.on('#modal-sponsor', 'hide', () => {
                    this.mode = 'create';
                    this.clearData();
                });

            });
        }

    }

</script>
