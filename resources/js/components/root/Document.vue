<template>
    
    <div id="modal-document" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <form class="uk-form-stacked uk-flex-middle" @submit.prevent="handleSubmit">
                
                <div class="uk-margin">
                    <label class="uk-form-label">Título del documento</label>
                    <input type="text" class="uk-input" v-model="title" required placeholder="Requerido">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Descripción del documento</label>
                    <textarea rows="5" class="uk-textarea" maxlength="255" v-model="description" required placeholder="Requerido"></textarea>
                </div>

                <div class="uk-margin">
                    <label for="document-user" class="uk-button uk-padding-remove"><span uk-icon="cloud-upload"></span> Agregar archivo</label>
                    <input id="document-user" type="file" hidden :required="mode == 'CREATE'">
                </div>

                <div class="uk-margin">
                    <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large" :disabled="loader">
                        {{ (mode == 'CREATE') ? 'Añadir documento' : 'Actualizar documento' }}
                        <span uk-spinner="ratio: 0.8" v-if="loader"></span>
                    </button>
                    <a href="#modal-documents" class="uk-button uk-button-default" uk-toggle>Cancelar</a>
                </div>

            </form>
            
        </div>
    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';

    export default {
        data () {
            return {
                loader: false,
                mode: 'CREATE',
                userID: '',
                public_id: '',
                title: '',
                description: ''
            }
        },
        methods: {
            handleSubmit: function () {
                if ( this.mode == 'CREATE' ) this.addDocument();
                else this.updateDocument();
            },
            getData: function () {
                
                let data = new FormData();
                
                data.append('title', this.title);
                data.append('description', this.description);
                if ( document.getElementById('document-user').files[0] ) {
                    data.append('file', document.getElementById('document-user').files[0]);
                }

                return data;
            },
            clearData: function () {
                this.mode = 'CREATE';
                this.userID = '';
                this.public_id = '';
                this.title = '';
                this.description = '';
                document.getElementById('document-user').value = "";
            },  
            addDocument: function () {

                let url  = route('app.root.documents.add', { id: this.userID });
                let data = this.getData();
                
                this.loader = true;

                axios.post(url, data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response => {

                    this.loader = false;

                    this.clearData();
                    UIkit.modal('#modal-documents').show();
                    EventBus.$emit('documentAdded', response.data);
                    UIkit.notification('Documento enviado al usuario', 'success');
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });
            },
            updateDocument: function () {

                let url  = route('app.root.documents.update', { id: this.userID, ID : this.public_id });
                let data = this.getData();

                this.loader = true;

                axios.post(url, data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response => {

                    this.loader = false;

                    this.clearData();
                    UIkit.modal('#modal-documents').show();
                    EventBus.$emit('documentUpdated', response.data);
                    UIkit.notification('Documento actualizado', 'success');
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created () {

            EventBus.$on('addDocument', (id) => {

                this.userID = id;

                UIkit.util.on('#modal-document', 'hide', () => {
                    this.clearData();
                });
            });

            EventBus.$on('updateDocument', (userID, document) => {

                this.mode        = 'UPDATE';
                this.userID      = userID;
                this.public_id   = document.public_id;
                this.title       = document.title;
                this.description = document.description;

                UIkit.util.on('#modal-document', 'hide', () => {
                    this.clearData();
                });
            });

        }
    }

</script>