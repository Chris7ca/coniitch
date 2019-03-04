<template>
    
    <div id="modal-service" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h4>Servicios</h4>

            <form class="uk-form-stacked uk-flex-middle uk-margin-medium" @submit.prevent="saveService">

                <div class="uk-margin">
                    <label class="uk-form-label">Concepto</label>
                    <input type="text" class="uk-input" v-model="service.concept" required placeholder="Nombre del servicio o producto">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-lable">Costo</label>
                    <input type="number" class="uk-input" v-model="service.price" required placeholder="$ 00.00 MXN">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Dirigido a</label>
                    <multiselect v-model="selectedRoles" :multiple="true" :searchable="false" label="name" 
                    track-by="value" :options="roles" required placeholder="Selecciona a quienes va dirigido el servico"></multiselect>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Descripción</label>
                    <textarea rows="5" class="uk-textarea" v-model="service.details" required placeholder="Detalles del producto o servicio..."></textarea>
                </div>

                <div class="uk-margin"> 
                    <div class="uk-padding-small uk-placeholder" style="min-height: 80px;">

                        <div class="uk-text-center">
                            <label for="sericeImages" class="uk-button uk-padding-remove"><span class="uk-margin-small-right" uk-icon="cloud-upload"></span> Agregar imágenes</label>
                            <input id="sericeImages" type="file" @change="handleFiles" multiple hidden>
                        </div>

                        <div class="uk-grid uk-flex-middle uk-margin-top" uk-grid>
                            
                            <div v-for="(file, i) in files" :key="i">
                                <div class="uk-visible-toggle uk-position-relative">
                                    <a role="button" class="uk-position-top-right uk-icon-button uk-hidden-hover" @click="removeFile(i)" uk-icon="icon: close; ratio: 0.9;"></a>
                                    <img :id="'preview_' + i" :src="previewImage(file, i)" style="max-width: 80px;">
                                </div>
                            </div>

                            <div v-for="(image, i ) in service.images" :key="i">
                                <div class="uk-visible-toggle uk-position-relative">
                                    <a role="button" class="uk-position-top-right uk-icon-button uk-hidden-hover" @click="removeImage(image, i)" uk-icon="icon: close; ratio: 0.9;"></a>
                                    <img :src="image.file.replace('public','/storage')" style="max-width: 80px;">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="uk-margin">
                    <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large" :disabled="loader">
                        {{ txtBtnSubmit }} <span class="uk-margin-small-right" uk-spinner="ratio: 0.8" v-if="loader"></span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';
    import Multiselect from 'vue-multiselect';
    
    export default {
        components:{
            Multiselect
        },
        data () {
            return {
                loader : false,
                mode : 'create',
                service: {
                    public_id : '',
                    concept   : '',
                    details   : '',
                    price     : '',
                    images    : [],
                    discounts : [],
                    for       : []
                },
                files: [],
                deleteImages: [],
                roles : [],
                selectedRoles : []
            }
        },
        watch: {
            selectedRoles: function (roles) {
                this.service.for = roles.map( role => ({ public_id: role.value, display_name: role.name }) );
            }
        },
        computed: {
            txtBtnSubmit: function () {
                return ( this.mode == 'create' ) ? 'Crear servicio' : 'Actualizar servicio';
            }
        },
        methods: {
            clearData: function () {
                this.service =  {
                    public_id : '',
                    concept   : '',
                    details   : '',
                    price     : '',
                    images    : [],
                    for       : []
                }
                this.files = [];
                this.deleteImages = [];
                this.selectedRoles = [];
                this.mode = 'create';
            },  
            getData: function () {
                
                let data = new FormData();

                data.append('public_id', this.service.public_id);
                data.append('concept', this.service.concept);
                data.append('details', this.service.details);
                data.append('price', this.service.price);
                
                this.service.for.forEach( role => { data.append('for[]', JSON.stringify(role)) });
                this.files.forEach( file => { data.append('images[]', file) });
                this.deleteImages.forEach( file => { data.append('delete_images[]', file) });

                return data;
            },
            saveService: function () {
                
                let url     = route('app.finances.services.save');
                let data    = this.getData();
                this.loader = true;

                axios.post(url, data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response => {
                    
                    this.loader = false;
                    
                    if ( this.mode == 'create' ) {
                        EventBus.$emit('serviceCreated', response.data);
                    } 

                    UIkit.util.on('#modal-service', 'hide', () => {
                        this.clearData();
                    });

                    UIkit.notification(`Servicio ${ (this.mode == 'create') ? 'creado' : 'actualizado' }`, 'success');
                    UIkit.modal('#modal-service').hide();

                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });

            },
            handleFiles: function(event) {

                let files = event.target.files;

                Array.from(files).forEach( file => {
                    
                    let ext = this.getExtension(file.name);

                    if ( ext == 'jpg' || ext == 'png' || ext == 'jpeg' ) {

                        this.files.push(file);

                    } else {
                        UIkit.notification(`El archivo ${file.name} no es válido`, 'warning');
                    }

                });
            },
            removeFile:  function(index) {
                this.files.splice(index, 1);
            },
            removeImage: function (image, index) {
                this.deleteImages.push(image.public_id);
                this.service.images.splice(index, 1);
            },
            getExtension: function (path) {
                
                let basename = path.split(/[\\/]/).pop();
                let pos = basename.lastIndexOf('.');

                if (basename === '' || pos < 1) {
                    return '';
                }
                return basename.slice(pos + 1);
            },
            previewImage: function (file, i) {

                let reader = new FileReader();
                
                reader.onload = (e) => {
                    document.getElementById(`preview_${i}`).setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(file);
            }
        },
        created () {

            axios.post(route('app.root.roles.simple.search'))
            .then( response => {
                response.data.forEach(role => {
                    this.roles.push({ name: role.display_name, value: role.public_id });
                });
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('editService', service => {
                
                this.mode    = 'update';
                this.service = service;

                this.selectedRoles = service.for.map( role => ({ name: role.display_name, value: role.public_id }) );

                UIkit.util.on('#modal-service', 'hide', () => {
                    this.clearData();
                });

            });

        }
    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>