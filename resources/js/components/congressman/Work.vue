<template>
    
    <div class="uk-form-stacked uk-grid uk-margin-large" uk-grid>

       <div class="uk-margin uk-width-1-2@m">
            <label class="uk-form-label">Titulo del trabajo</label>
            <input type="text" v-model="title" class="uk-input" placeholder="Campo requerido" required>
        </div>

        <div class="uk-margin uk-margin-remove-top uk-width-1-2@m">
            <label class="uk-form-label">Adscripción</label>
            <input type="text" v-model="adscription" class="uk-input" placeholder="Campo requerido" required>
        </div>

        <div class="uk-margin uk-width-1-3@m">
            <label class="uk-form-label">Tema del trabajo</label>
            <multiselect v-model="theme" :searchable="false" label="name" track-by="value" :options="themes" 
            required placeholder="Selecciona un tema"></multiselect>
        </div>

        <div class="uk-margin uk-width-1-3@m">
            <label class="uk-form-label">Modalidad</label>
            <multiselect v-model="type" :searchable="false" label="name" track-by="value" :options="types" 
            required placeholder="Selecciona una modalidad"></multiselect>
        </div>

        <div class="uk-margin uk-width-1-3@m">
            <label class="uk-form-label">Eje</label>
            <multiselect v-model="axis" :searchable="false" label="name" track-by="value" :options="axes" 
            required placeholder="Selecciona un eje"></multiselect>
        </div>

        <div class="uk-margin uk-width-1-1">
            <ul uk-accordion>
                <li>
                    <a role="button" class="uk-accordion-title">Autoría <small>(si desea agregar coautores)</small></a>

                    <div class="uk-accordion-content">

                        <div>
                            <label class="uk-form-label">Coautores</label>

                            <div class="uk-flex-middle" uk-grid>
                            
                                <div class="uk-width-1-3@m">
                                    <input type="text" class="uk-input" v-model="fullNameCoauthor" placeholder="Nombre completo">              
                                </div>

                                <div class="uk-width-1-3@m">
                                    <input type="text" class="uk-input" v-model="emailCoauthor" placeholder="Correo electrónico">              
                                </div>

                                <div class="uk-width-1-3@m">
                                    <input type="text" class="uk-input" v-model="adscriptionCoauthor" placeholder="Adscripción">              
                                </div>

                                <div class="uk-width-auto uk-margin-small-top">
                                    <label><input class="uk-checkbox" type="checkbox" v-model="isFirstAuthor"> Primer autor</label>
                                </div>

                                <div class="uk-width-auto uk-margin-small-top">
                                    <a role="button" class="uk-link-reset" @click="addCoauthor" v-if="modeCoauthors == 'create'">Agregar coautor</a>
                                    <a role="button" class="uk-link-reset" @click="updateCoauthor" v-else>Actualizar información</a>
                                </div>

                            </div>

                        </div>

                        <table class="uk-table uk-table-divider uk-table-middle uk-table-responsive uk-margin-medium" v-if="coauthors.length > 0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Adscripción</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(coauthor, index) in coauthors" :key="index">
                                    <td>{{ coauthor.full_name }}</td>
                                    <td>{{ coauthor.email }}</td>
                                    <td>{{ coauthor.adscription }}</td>
                                    <td>{{ (coauthor.is_first_author) ? 'Autor principal' : 'Coautor' }}</td>
                                    <td>
                                        <ul class="uk-iconnav">
                                            <li><a role="button" @click="editCoautor(index)" uk-icon="file-edit"></a></li>
                                            <li><a role="button" @click="deleteCoauthor(index)" uk-icon="trash"></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </li>
            </ul>
        </div>

        <div class="uk-margin uk-width-1-1">
            <label class="uk-form-label">Resumen <span uk-icon="info" uk-tooltip="Para habilitar la edición especial, solo selecciona el texto."></span></label>
            <editor :id="'editor_register_work'" v-model="content" :value="''" :count-words="true" :limit-words="310" @limit-words="limitWordsReached"></editor>
        </div>

        <div class="uk-margin">
            <button class="uk-button uk-button-default uk-width-auto" @click="saveWork" :disabled="loading">
                Guardar <span class="uk-text-primary" uk-spinner="ratio: 0.6" v-if="loadingSave"></span>
            </button>
            <button class="uk-button uk-button-primary uk-box-shadow-hover-large uk-width-auto" @click="confirmWork" :disabled="loading || work == null">
                {{ (mode == 'register') ? 'Registrar trabajo' : 'Actualizar trabajo' }} 
                <span class="uk-text-primary" uk-spinner="ratio: 0.6" v-if="loadingConfirmation"></span>
            </button>
        </div>
        
    </div>

</template>

<script>

    import Editor from './../helpers/Editor.vue';
    import Multiselect from 'vue-multiselect';

    export default {

        components: {
            Editor, Multiselect
        },
        props: ['orgWork','mode'],
        data () {
            return {
                loading             : false,
                loadingSave         : false,
                loadingConfirmation : false,
                work                : this.orgWork,
                axes                : [
                    { value: 'Research',    name: 'Investigación' },
                    { value: 'Theoretical', name: 'Teórico' }
                ],
                types               : [
                    { value: 'Oral',   name: 'Oral' },
                    { value: 'Banner',  name: 'Cartel' }
                ],
                themes              : [
                    { value: 'Transdiscipline', name: 'Transdisciplina' },
                    { value: 'Health and Society', name: 'Salud y Sociedad' }
                ],
                title                : '',
                theme                : '',
                isFirstAuthor        : false,
                coauthors            : [],
                deleteCoauthors      : [],
                modeCoauthors        : 'create',
                indexCoauthor        : null,
                fullNameCoauthor     : '',
                emailCoauthor        : '',
                adscriptionCoauthor  : '',
                adscription          : '',
                type                 : '',
                axis                 : '',
                content              : ''
            }
        },
        methods: {
            clearInputsCoauthor: function () {
                this.fullNameCoauthor    = '';
                this.adscriptionCoauthor = '';
                this.emailCoauthor       = '';
                this.isFirstAuthor       = false;
            },  
            addCoauthor: function () {

                let existsFirstAuthor    = this.coauthors.filter( c => c.is_first_author == true);
                let duplicateFirstAuthor = (this.isFirstAuthor && (existsFirstAuthor.length == 1));
                
                if (this.fullNameCoauthor != '' && this.emailCoauthor != '' && this.adscriptionCoauthor != '' && !duplicateFirstAuthor ) {
                    
                    let coauthor = {
                        public_id       : '',
                        full_name       : this.fullNameCoauthor,
                        adscription     : this.adscriptionCoauthor,
                        email           : this.emailCoauthor,
                        is_first_author : this.isFirstAuthor
                    };

                    this.coauthors.push(coauthor);
                    this.clearInputsCoauthor();

                } else {
                    UIkit.notification('Debes ingresar los datos requeridos y no asignar a dos personas como autores principales', 'warning');
                }
            },
            editCoautor: function (index) {

                this.modeCoauthors       = 'update';
                this.indexCoauthor       = index;
                this.fullNameCoauthor    = this.coauthors[index].full_name;
                this.adscriptionCoauthor = this.coauthors[index].adscription;
                this.emailCoauthor       = this.coauthors[index].email;
                this.isFirstAuthor       = this.coauthors[index].is_first_author;
            },
            updateCoauthor: function () {
                
                let index = this.indexCoauthor;

                this.modeCoauthors                      = 'create';
                this.coauthors[index].full_name         = this.fullNameCoauthor;
                this.coauthors[index].adscription       = this.adscriptionCoauthor;
                this.coauthors[index].email             = this.emailCoauthor;
                this.coauthors[index].is_first_author   = this.isFirstAuthor;
                this.clearInputsCoauthor();
            },
            deleteCoauthor: function (index) {
                
                UIkit.modal.confirm('¿Seguro que deseas eliminar a este coautor?').then(() => {

                    if ( this.coauthors[index].public_id != '' ) {
                        this.deleteCoauthors.push(this.coauthors[index].public_id);
                    }
                    
                    this.coauthors.splice(index, 1);

                }, () => {});
            },
            getData: function () {

                let existsFirstAuthor  = this.coauthors.filter( c => c.first_author == true);
                let public_id          = (this.work) ? this.work.public_id : '';
                let text               = (this.content != "<p>&nbsp;</p>")
                                            ? this.content : '';

                return {
                    id                      : public_id,
                    title                   : this.title,
                    theme                   : this.theme.value,
                    coauthors               : this.coauthors,
                    adscription             : this.adscription,
                    type                    : this.type.value,
                    axis                    : this.axis.value,
                    content                 : text,
                    im_first_author         : this.imFirstAuthor,
                    has_coauthors_to_delete : this.deleteCoauthors
                }                
            },
            saveWork: function () {

                let data            = this.getData();
                let url             = route('app.congressman.announcement.save');
                this.loading        = true;
                this.loadingSave    = true;

                axios.post(url, data)
                .then( response => {

                    this.loading        = false;
                    this.loadingSave    = false;
                    this.work           = response.data;
                    this.coauthors      = (response.data.coauthors) ? response.data.coauthors : [];
                    UIkit.notification('Todos los cambios guardados', 'success');
                }) 
                .catch( error => {
                    
                    this.loading        = false;
                    this.loadingSave    = false;
                    showAxiosErrorMessage(error);
                });             
            },
            confirmWork: function () {

                let note = ( this.fullNameCoauthor != '' && this.adscriptionCoauthor != '' && this.emailCoauthor != '' ) ? 'No ha agregado a un coautor' : '';

                UIkit.modal.confirm(`¿Estás seguro que deseas confirmar todos los cambios en tu trabajo? Una vez hecho esto, no podrás modificar la información contenida en él. ${note}`)
                .then( () => {

                    let url                     = route('app.congressman.announcement.confirm', { id : this.work.public_id });
                    this.loading                = true;
                    this.loadingConfirmation    = true;

                    axios.post(url)
                    .then( response => {

                        this.loading                = false;
                        this.loadingConfirmation    = false;
                        UIkit.notification(response.data.message, 'success');
                        setTimeout(() => {
                            window.location = route('app.congressman.announcement.view');
                        }, 600);
                    }) 
                    .catch( error => {
                        
                        this.loading                = false;
                        this.loadingConfirmation    = false;
                        showAxiosErrorMessage(error);
                    });

                }, () => {});  
            },
            limitWordsReached: function (words) {
                this.loading = (words > 0);
            }
        },
        created () {

            if ( this.work ) {
                
                this.title       = (this.work.title) ? this.work.title : '';
                this.adscription = (this.work.adscription) ? this.work.adscription : '';     
                this.content     = (this.work.content) ? this.work.content : '';    
                this.axis        = (this.work.axis) ? this.axes.filter( a => a.value == this.work.axis )[0] : '';
                this.type        = (this.work.type) ? this.types.filter( t => t.value == this.work.type )[0] : '';
                this.theme       = (this.work.theme) ? this.themes.filter( th => th.value == this.work.theme )[0] : '';
                this.coauthors   = (this.work.coauthors) ? this.work.coauthors : [];
            }

        }

    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>