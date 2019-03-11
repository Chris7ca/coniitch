<template>

    <div id="modal-sponsor" class="uk-modal-container uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-position-relative">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h4>Formualrio para crear o editar patrocinadores</h4>
            <hr class="uk-divider-small">

            <form @submit.prevent="handleSubmit" class="uk-grid uk-grid-large uk-flex-middle" uk-grid>

                <div class="uk-width-auto@m uk-flex uk-flex-column uk-flex-center uk-text-center">

                    <div class="uk-placeholder uk-margin" style="min-height: 100px; width: 300px;">
                        <img :src="image" :width="width" v-if="imageLoaded">
                        <img src="/svg/spinner.svg" v-else>
                        <span v-if="errorFile" class="uk-text-danger uk-text-small uk-margin">{{ textErrorFile }}</span>
                    </div>

                    <div class="uk-margin">
                        <label for="image-sponsor"><span class="uk-margin-small-right uk-margin-remove-top" uk-icon="image"></span> Cambiar imagen del patrocinador</label>
                        <input type="file" id="image-sponsor" @change="changeImage" accept="image/png" hidden>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label">Ancho de la imagen <span class="uk-margin-small-left" uk-tooltip="Si no se especifíca el ancho de la imagen, tomará el ancho original"></span></label>
                        <input type="number" v-model="width" class="uk-input" placeholder="Tamaño en píxeles">
                    </div>

                </div>

                <div class="uk-width-expand@m">

                    <div class="uk-form-stacked">

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
                            <button class="uk-button uk-button-primary" type="submit">{{ textBtnSubmit }}</button>
                        </div>
        
                    </div>

                </div>

            </form>

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
                width: 'auto',
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
                this.width = 'auto',
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
                formData.append('width', this.width);
                formData.append('image', image);

                return formData;
            },
            handleSubmit: function () {

                if ( this.url != '' && this.description != '' ) {

                    UIkit.notification('Solo puedes agregar descripción del patrocinador o una url', 'warning');
                }
                if ( this.mode == 'create' && !document.getElementById('image-sponsor').files[0] ) {

                    UIkit.notification('Debes cargar una imagen del patricinador', 'warning');

                } else {
                    ( this.mode == 'create' ) ? this.storeSponsor() : this.updateSponsor(); 
                }

            },
            storeSponsor: function () {

                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.publicrelations.sponsors.store'), data, {
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

                axios.post(route('app.publicrelations.sponsors.update', { id : this.id }), data, {
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
            
            EventBus.$on('editSponsor', sponsor => {

                this.mode = 'update';

                this.id             = sponsor.public_id;
                this.url            = (sponsor.url != null) ? sponsor.url : '';
                this.width          = sponsor.image.width;
                this.image          = sponsor.image.file.replace('public', '/storage');
                this.displayName    = sponsor.display_name;
                this.description    = (sponsor.description != null) ? sponsor.description : '';

                UIkit.util.on('#modal-sponsor', 'hide', () => {
                    this.mode = 'create';
                    this.clearData();
                });

            });
        }

    }

</script>
