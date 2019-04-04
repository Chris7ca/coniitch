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
                        <small v-if="record.email_verified_at">Correo verificado</small>
                        <small class="uk-text-warning" v-else>Correo no verificado</small>
                    </td>
                    <td>
                        <ul class="uk-iconnav uk-flex uk-flex-center">
                            <li v-if="record.academic_profile && record.academic_profile.document">
                                
                                <a role="button" :class="{ 'uk-text-warning' : record.academic_profile.is_student == null }" uk-icon="folder" uk-tooltip="Este congresista ha adjuntado un archivo probatorio de su estatus académico"></a>
                                
                                <div uk-dropdown="mode: click">
                                    
                                    <ul class="uk-nav uk-nav-default" v-if="validation">
                                        <li>
                                            <a :href="urlDocument(record.academic_profile.document)" target="_blank"><span class="uk-margin-small-right" uk-icon="download"></span> Descargar archivo</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, true)"><span class="uk-margin-small-right" uk-icon="check"></span> Aprobar documento</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, false, 'La credencial de estudiante ha expirado')"><span class="uk-margin-small-right" uk-icon="close"></span> La credencial de estudiante ha expirado</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, false, 'La credencial de estudiante no indica vigencia')"><span class="uk-margin-small-right" uk-icon="close"></span> La credencial de estudiante no indica vigencia</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, false, 'La credencial de estudiante no tiene vigencia')"><span class="uk-margin-small-right" uk-icon="close"></span> La credencial de estudiante no tiene vigencia</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, false, 'Recibo de pago no vigente')"><span class="uk-margin-small-right" uk-icon="close"></span> Recibo de pago no vigente</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, false, 'Constancia de estudio no es actual')"><span class="uk-margin-small-right" uk-icon="close"></span> Constancia de estudio no es actual</a>
                                        </li>
                                        <li v-if="record.academic_profile.is_student == null">
                                            <a role="button" @click="validateDocument(record, false, 'El documento no cuenta con sello de la institución')"><span class="uk-margin-small-right" uk-icon="close"></span> El documento no cuenta con sello de la institución</a>
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
            validateDocument: function (record, status, reason = '') {

                let url = route('app.finances.records.documents.validation', { id : record.public_id });
                this.validation = false;

                axios.post(url, { validation : status, reason: reason })
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
