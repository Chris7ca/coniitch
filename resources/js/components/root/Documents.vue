<template>
    
    <div id="modal-documents" class="uk-modal-container uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h3>Documentos adjuntos</h3>

            <div class="uk-text-center" v-if="loader">
                <h5>Cargando ... <span uk-spinner="ratio: 0.8"></span></h5>
            </div>

            <div class="uk-padding-large uk-text-center uk-placeholder" v-else-if="!loader && documents.length == 0">
                <h5>
                    No hay documentos para este usuario, ¿Deseas <a href="#modal-document" class="text-secondary" @click="addDocument" uk-toggle>adjuntar</a> un documento?
                </h5>
            </div>

            <div class="uk-grid uk-grid-match uk-child-width-1-4@xl uk-child-width-1-3@l uk-child-width-1-2@s uk-margin-large-top" uk-grid uk-height-match="target: > div > .uk-card" v-else>

                <div v-for="(document, index) in documents" :key="index">
                    <div class="uk-card uk-card-primary uk-card-body uk-box-shadow-small uk-box-shadow-hover-large uk-light">

                        <h5>{{ document.title }}</h5>

                        <p>{{ document.description }}</p>

                        <ul class="uk-iconnav uk-flex uk-flex-right uk-margin-medium-top">
                            <li>
                                <a :href="document.file.replace('public','/storage')" target="_blank" uk-icon="forward"></a>
                            </li>
                            <li>
                                <a href="#modal-document" @click="updateDocument(document)" uk-icon="file-edit" uk-toggle></a>
                            </li>
                            <li>
                                <a role="button" @click="deleteDocument(document.public_id)" uk-icon="trash"></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <div class="uk-card uk-card-body uk-placeholder uk-flex uk-flex-middle uk-flex-center">
                        <div>
                            <a href="#modal-document" @click="addDocument" uk-icon="plus-circle" uk-toggle></a>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';

    export default {
        data () {
            return {
                loader: false,
                userID: '',
                documents: [],
            }
        },
        methods: {
            addDocument: function () {
                EventBus.$emit('addDocument', this.userID);
            },
            updateDocument: function (document) {
                EventBus.$emit('updateDocument', this.userID, document);
            },
            deleteDocument: function (id) {
                
                let self = this;

                UIkit.modal.confirm('¿Estás seguro de eliminiar este documento?').then(function() {
                    
                    let url = route('app.root.documents.delete', { id : self.userID, ID : id });

                    axios.delete(url)
                    .then( response => {

                        let index = self.documents.findIndex( d => d.public_id == id );

                        self.documents.splice(index, 1);
                        UIkit.notification(response.data.message, 'success');
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });
                    
                }, () => {});
                
            }
        },
        created () {

            EventBus.$on('documentsUser', userID => {

                let url     = route('app.root.documents.user', { id : userID });

                this.loader = true;
                this.userID = userID;

                axios.post(url)
                .then( response => {

                    this.loader     = false;
                    this.documents  = response.data;
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });

            });

            EventBus.$on('documentAdded', document => {
                this.documents.push(document);
            });

            EventBus.$on('documentUpdated', document => {
                
                let index = this.documents.findIndex( d => d.public_id == document.public_id );

                this.documents[index].title = document.title;
                this.documents[index].description = document.description;
                this.documents[index].file = document.file;
            });

        }
    }

</script>