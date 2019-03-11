<template>

    <div class="uk-margin-medium">

        <div>

            <pagination :url="recordsUrl" @updateItems="updateItems" @updateLoader="updateLoader"></pagination>

        </div>
    
        <table class="uk-table uk-table-divider uk-table-middle uk-table-responsive uk-margin-large">

            <thead>
                <th class="uk-table-shrink"></th>
                <th class="uk-table-shrink">Registro</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th class="uk-table-shrink">Estatus</th>
                <th class="uk-text-center">Opciones</th>
            </thead>

            <tbody>

                <tr v-for="(record, index) in records" :key="index">
                    
                    <td>
                        <img class="avatar-small uk-preserve-width" :data-src="getAvatar(record.avatar)" uk-img>
                    </td>
                    <td>
                        {{ getDate(record) }}
                    </td>
                    <td>
                        <a href="#modal-profile" class="uk-button button-text uk-padding-remove" @click="showProfile(record.public_id)" uk-toggle>{{ record.first_name + ' ' + record.last_name }}</a>
                    </td>
                    <td>
                        {{ record.email }}
                    </td>
                    <td class="uk-text-center">
                        <small v-if="record.email_verified_at">Congresista verificado</small>
                        <small class="uk-text-warning" v-else>Congresista no verificado</small>
                    </td>
                    <td>
                        <ul class="uk-iconnav uk-flex uk-flex-center">
                            <li v-if="record.academic_profile && record.academic_profile.document">
                                
                                <a role="button" uk-icon="folder" uk-tooltip="Este congresista ha adjuntado un archivo probatorio de su estatus académico"></a>
                                
                                <div uk-dropdown="mode: click">
                                    
                                    <ul class="uk-nav uk-nav-default" v-if="validation">
                                        <li>
                                            <a :href="urlDocument(record.academic_profile.document)" target="_blank"><span class="uk-margin-small-right" uk-icon="download"></span> Descargar archivo</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, true)"><span class="uk-margin-small-right" uk-icon="check"></span> Aprobar documento</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, false)"><span class="uk-margin-small-right" uk-icon="close"></span> Rechazar documento</a>
                                        </li>
                                    </ul>

                                    <div v-else>
                                        Cargando... <span uk-spinner="ratio: 0.9"></span>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </td>

                </tr>

            </tbody>

            <tfoot>

                <tr v-if="loader">
                    <td class="uk-text-center" colspan="6">
                        Cargando datos... <span class="uk-margin-small-left" uk-spinner="ratio:0.8"></span>  
                    </td>
                </tr>

                <tr v-else-if="!loader && records.length == 0">
                    <td class="uk-text-center" colspan="6">
                        <h6>No hay registros aún...</h6>
                    </td>
                </tr>

            </tfoot>

        </table>

    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';
    import Pagination from './../helpers/Pagination.vue';

    export default {
        components: {
            Pagination
        },
        data () {
            return {
                loader: true,
                validation: true,
                records: [],
                recordsUrl: route('app.finances.records.index')
            }
        },
        methods: {
            showProfile: function (id) {
                EventBus.$emit('showProfile', id);
            },
            getDate: function (record) {

                let createdAt  = record.created_at
                let createdAgo = record.created_ago;
                
                let now     = new Date();
                let today   = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                let array   = createdAt.substring(0, 10).split('-');
                let date    = new Date(array[0], (array[1] - 1), array[2]);
                
                let days    = (today - date) / 1000 / 60 / 60 / 24; 

                return ( days > 7 ) ? createdAt.substring(0, (createdAt.length - 3)) : createdAgo;
            },
            urlDocument: function (url) {

                return url.replace('public','/storage');
            },
            validateDocument: function (record, status) {

                let url = route('app.finances.records.documents.validation', { id : record.public_id });
                this.validation = false;

                axios.post(url, { validation : status })
                .then( response => {
                    
                    this.validation = true;
                    record.academic_profile.is_student = status;

                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.validation = true;
                    showAxiosErrorMessage(error);
                });
            },
            updateItems: function (items) {
                this.records = items;
            },
            updateLoader: function (status) {
                this.loader = status;
            }
        },
    }

</script>
