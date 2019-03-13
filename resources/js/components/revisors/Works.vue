<template>
    
    <table class="uk-table uk-table-middle uk-table-responsive uk-table-divider">
            
        <thead>
            <tr>
                <th class="uk-table-shinrk"></th>
                <th class="uk-table-expand">Trabajo</th>
                <th class="uk-table-shrink">Tema</th>
                <th class="uk-table-shrink">Eje</th>
                <th class="uk-table-shrink">Modalidad</th>
                <th class="uk-table-shrink">Estatus</th>
                <th class="uk-text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <tr v-if="!dataLoaded">
                <td colspan="7" class="uk-text-center">Cargando... <div class="uk-margin-small-left" uk-spinner="ratio: 0.9"></div></td>
            </tr>
            
            <tr v-for="(work, index) in works" :key="index" v-else>
                <td v-html="tagWork(work)">
                    
                </td>
                <td>
                    <h6>{{ work.title }}</h6>
                </td>
                <td>
                    {{ (work.theme == 'Transdiscipline') ? 'Transdisciplina' : 'Salud y Sociedad' }}
                </td>
                <td>
                    {{ (work.axis == 'Research') ? 'Investigación' : 'Teórico' }}
                </td>
                <td>
                    {{ (work.type == 'Banner') ? 'Cartel' : 'Oral' }}
                </td>
                <td>
                    <span class="uk-text-warning" v-if="work.reviews[0] == undefined">Sin evaluar</span>
                    <span class="uk-text-primary" v-else-if="work.reviews[0].score == null">Esperando evaluación de correcciones</span>
                    <span class="uk-text-primary" v-else-if="work.reviews[0].score == 1">Aprobado</span>
                    <span class="uk-text-primary" v-else-if="work.reviews[0].score == 2">Aprobado con correcciones</span>
                    <span class="uk-text-danger"  v-else-if="work.reviews[0].score == 3">Rechazado</span>
                </td>
                <td>

                    <div v-if="loader" uk-spinner></div>

                    <ul class="uk-iconnav uk-flex uk-flex-center" v-if="!loader">
                        <li>
                            <a :href="route('app.congressman.announcement.works.show', { id : work.public_id })" uk-icon="eye" uk-tooltip="Ver trabajo"></a>
                        </li>
                        <li v-if="work.confirmation.status == null">
                            <a role="button" @click="responseRequest(work.public_id, true)" uk-icon="check" uk-tooltip="Aceptar evaluar el trabajo"></a>
                        </li>
                        <li v-if="work.confirmation.status == null">
                            <a role="button" @click="responseRequest(work.public_id, false)" uk-icon="close" uk-tooltip="No evaluar el trabajo"></a>
                        </li>
                        <li v-if="work.confirmation.status == 1">
                            <a href="#modal-evaluation" @click="evaluateWork(work)" uk-icon="file-edit" uk-tooltip="Evaluar" uk-toggle></a>
                        </li>
                    </ul>

                </td>
                
            </tr>

        </tbody>
        
        <tfoot>
            
            <tr v-if="dataLoaded && works.length == 0">
                <td class="uk-text-center uk-text-muted" colspan="7">
                    <h6>No te han asignado trabajos aún...</h6>
                </td>
            </tr>

        </tfoot>

    </table>

</template>

<script>

    import { EventBus } from './../../bus.js';
    
    export default {
        
        props: ['revisor'],
        data() {
            return {
                works: [],
                loader: false,
                dataLoaded: false,
            }
        },
        methods: {
            tagWork: function (work) {
              
                if ( work.confirmation.status == null )
                    return ' <span class="uk-badge" uk-tooltip="Nuevo trabajo">N</span>';

                else if ( work.reviews[0] != undefined && work.reviews[0].score != null )
                    return '<span class="uk-badge badge-success" uk-tooltip="Trabajo evaluado">E</span>';

                else if ( work.reviews[0] != undefined && work.reviews[0].score == null )
                    return '<span class="uk-badge badge-warning" uk-tooltip="Correcciones por revisar">C</span>'

            },
            responseRequest: function (id, res) {
                
                let url = route('app.revisors.works.confirmation', { id });
                this.loader = true;

                axios.post(url, { response: res })
                .then( response => {
                    this.loader = false;
                    let index = this.works.findIndex( w => w.public_id == id );
                    this.works[index].confirmation.status = res;
                    UIkit.notification(response.data.message, 'success');
                    if (!res) {
                        this.works.splice(index, 1);
                    }
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });

            },
            evaluateWork: function (work) {
                EventBus.$emit('evaluateWork', work);
            }
        },
        created() {

            let url = route('app.revisors.works.index');

            axios.post(url)
            .then( response => {
                this.dataLoaded = true;
                this.works = response.data;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });

        }

    }
    
</script>
