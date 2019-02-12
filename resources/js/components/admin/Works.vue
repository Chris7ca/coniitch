<template>
    
    <table class="uk-table uk-table-middle uk-table-divider uk-table-responsive">

        <thead>
            <tr>
                <th class="uk-table-shrink"></th>
                <th class="uk-table-expand">Trabajo</th>
                <th class="uk-table-shrink"></th>
                <th class="uk-table-expand">Revisores</th>
                <th>Estatus</th>
                <th class="uk-table-shrink uk-text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <tr v-if="!dataLoaded">
                <td colspan="5" class="uk-text-center">
                    Cargando... <div class="uk-margin-small-left" uk-spinner="ratio: 0.9"></div>
                </td>
            </tr>

            <tr v-for="(work, index) in works" :key="index" v-else>

                <td v-html="tagWork(work)">
                    
                </td>

                <td>
                    <h6>{{ work.title }}</h6>
                </td>

                <td style="width: 20px;">
                    <ul class="uk-list" v-if="work.revisors.length > 0">
                        <li v-for="(revisor, i) in work.revisors" :key="i" v-html="revisorsStatus(revisor.confirmation.status)"></li>
                    </ul>
                </td>

                <td>
                    <span class="uk-text-small uk-text-muted" v-if="work.revisors.length == 0">Aún no asignas este trabajo...</span>

                    <ul class="uk-list uk-text-small" v-else>
                        <li v-for="(revisor, i) in work.revisors" :key="i">
                            {{ revisor.first_name + ' ' + revisor.last_name }}
                        </li>
                    </ul>
                </td>

                <td v-html="statusWork(work)">
                    
                </td>

                <td>
                    <ul class="uk-iconnav uk-flex uk-flex-center">
                        <li>
                            <a :href="route('app.announcement.works.show', { id : work.public_id })" uk-icon="expand" uk-tooltip="Ver trabajo"></a>
                        </li>
                        <li v-if="isAssignable(work)">
                            <a href="#modal-assign-revisors" @click="assignRevisors(work.public_id)" uk-icon="forward" uk-toggle uk-tooltip="Asignar revisor"></a>
                        </li>
                        <li v-if="work.reviews.length > 0">
                            <a href="#modal-reviews" @click="showReviews(work)" uk-icon="copy" uk-toggle uk-tooltip="Ver evaluaciones"></a>
                        </li>
                        <li v-if="notifiableStatus(work)">
                            <a role="button" uk-icon="bell" @click="notify(work)" uk-tooltip="Notificar la evaluación"></a>
                        </li>
                    </ul>
                </td>

            </tr>

        </tbody>

        <tfoot>
            <tr v-if="dataLoaded && works.length == 0">
                <td class="uk-text-center" colspan="6">
                    <h6 class="uk-text-muted">No hay trabajos nuevos aún...</h6>
                </td>
            </tr>
        </tfoot>

    </table>

</template>

<script>
    
    import { EventBus } from './../../bus.js';

    export default {
        
        data () {
            return {
                dataLoaded: false,
                works: []
            }
        },
        methods: {
            tagWork: function (work) {
                
                if ( work.revisors.length == 0 && work.reviews.length == 0) 
                    return '<span class="uk-badge" uk-tooltip="Nuevo trabajo">N</span>';

                else if ( work.reviews.length >= 2 && work.evaluation == null )
                    return '<span class="uk-badge badge-warning" uk-tooltip="Esperando Evaluación">E</span>';

                else if ( work.reviews.length >= 2 && work.evaluation == 1 )
                    return '<span class="uk-badge badge-success" uk-tooltip="Trabajo aprobado">A</span>';

                else if ( work.reviews.length >= 2 && work.evaluation == 2 )
                    return '<span class="uk-badge badge-warning" uk-tooltip="Esperando correcciones">E</span>';

                else if ( work.reviews.length >= 2 && work.evaluation == 3 )
                    return '<span class="uk-badge badge-danger" uk-tooltip="Trabajo rechazado">R</span>';

            },
            statusWork: function (work){

                let finalNote = this.finalNote(work);

                if  ( work.revisors.length == 0 )
                    return '<span class="uk-text-small uk-text-muted">Esperando asignación</span>';

                else if ( work.revisors.length > 0 && work.reviews.length < 2 ) 
                    return '<span class="uk-text-small uk-text-muted">Esperando evaluación</span>';

                else if ( finalNote == null )
                    return '<span class="uk-text-small uk-text-warning">Requiere nuevo revisor</span>';

                else if ( finalNote == 0 )
                    return '<span class="uk-text-small uk-text-warning">Esperando evaluación de los cambios</span>';
                    
                else if ( finalNote == 1 )
                    return '<span class="uk-text-small uk-text-primary">Aprobado</span>';

                else if ( finalNote == 2 && work.version == 1)
                    return '<span class="uk-text-small uk-text-primary">Aprobado con correcciones</span>';
                    
                else if ( finalNote == 3 || (finalNote == 2 && work.version >= 2) )
                    return '<span class="uk-text-small uk-text-danger">Rechazado</span>';

            },
            revisorsStatus: function (status) {

                if (status == null) {
                    return '<span uk-icon="clock" uk-tooltip="Esperando confirmación del revisor"></span>';
                } else if(status == 1) {
                    return '<span uk-icon="check" uk-tooltip="Asignación aceptada"></span>';
                } else {
                    return '<span uk-icon="close" uk-tooltip="Asignación rechazada"></span>';
                }

            },
            finalNote: function (work) {

                if ( work.reviews.length == work.revisors.length ) {

                    let finalNote = undefined;
                    let obj = {
                        aproved: 0,
                        changes: 0,
                        rejected: 0,
                        awaiting: 0,
                    };

                    work.reviews.forEach(review => {
                        
                        if ( review.score == 1 ) obj.aproved += 1;

                        else if ( review.score == 2 ) obj.changes += 1;
                        
                        else if ( review.score == 3 ) obj.rejected += 1;

                        else if ( review.score == null ) obj.awaiting += 1;

                    });

                    if ( obj.aproved >= 2 ) finalNote = 1;

                    else if ( obj.changes >= 2 || (obj.aproved == 1 && obj.changes == 1) ) finalNote = 2;

                    else if ( obj.rejected >= 2  ) finalNote = 3;

                    else if ( obj.awaiting >= 1 ) finalNote = 0;

                    else finalNote = null;

                    return ( finalNote == 2 && work.version == 2 ) ? 3 : finalNote; 

                } else  {
                    return 0;
                }
            },
            isAssignable: function(work) {

                if ( work.revisors.length == 0 ) {

                    return true;

                } else {

                    let assignments = 0;

                    work.revisors.forEach(revisor => {
                        if ( revisor.confirmation.status == 1 || revisor.confirmation.status == null ) {
                            assignments += 1;
                        }
                    });

                    return ( assignments < 2 || (work.reviews.length > 1 && this.finalNote(work) == null) ); 
                }
            },
            assignRevisors: function (id) {
                EventBus.$emit('assignRevisors', id);
            },
            showReviews: function (work) {
                EventBus.$emit('showReviews', work);
            },
            notifiableStatus: function (work) {

                let finalNote = this.finalNote(work);

                return ((finalNote != 0 && finalNote != null ) && work.evaluation == null);  
            },
            notify: function (work) {
                
                UIkit.modal.confirm('¿Deseas notificar al congresista la evaluación de su trabajo?').then( () => {
                    
                    let url   = route('app.admin.works.evaluation.confirm', { id : work.public_id });
                    let score = this.finalNote(work);

                    axios.post(url, { final_score : ( score == 2 && work.version >= 2 ) ? 3 : score })
                    .then( response => {

                        let index = this.works.findIndex( w => w.public_id == work.public_id);
                        this.works[index].evaluation = ( score == 2 && work.version >= 2 ) ? 3 : score;

                        UIkit.notification(response.data.message, 'success');
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });                 

                }, {});

            }
        },
        created () {
            
            let url = route('app.admin.works.index');

            axios.post(url)
            .then( response => {
                this.dataLoaded = true;
                this.works = response.data;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });

            EventBus.$on('assignedRevisors', (id, revisors) => {

                let index = this.works.findIndex( w => w.public_id == id );

                revisors.forEach( revisor => {
                    this.works[index].revisors.push({
                        first_name: revisor.first_name,
                        last_name: revisor.last_name,
                        confirmation: { status: null }
                    });
                });

            });

        }

    }

</script>
