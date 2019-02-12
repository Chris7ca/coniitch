<template>
    
    <div id="modal-reviews" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-width-4-5">
            <button class="uk-modal-close-default" type="button" uk-close></button>

            <div v-if="work != null && !loading">
                
                <h4 class="uk-margin-remove">{{ work.title }}</h4>
                <span>{{ work.adscription_work }}</span>

                <ul uk-tab>
                    <li v-for="(review, index) in work.reviews" :key="index">
                        <a role="button">{{ review.author.first_name + ' ' + review.author.last_name }}</a>
                    </li>
                </ul>

                <ul class="uk-switcher uk-margin">
                    <li v-for="(review, index) in work.reviews" :key="index">

                        <table class="uk-table uk-table-middle uk-table-divider uk-table-responsive">
                    
                            <thead>
                                <tr>
                                    <th>Criterio</th>
                                    <th class="uk-table-expand">Descripción</th>
                                    <th>Evaluación</th>
                                </tr>
                            </thead>
            
                            <tbody>
                                <tr v-for="(evaluation, index) in review.evaluations" :key="index">
                                    <td class="uk-text-small">{{ evaluation.criteria.title }}</td>
                                    <td class="uk-text-small">{{ evaluation.criteria.description }}</td>
                                    <td>{{ getEvaluation(evaluation.score) }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Justificación del dictamen</h5>
                                    </td>
                                    <td colspan="2">{{ review.feedback }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Dictamen</h5>
                                    </td>
                                    <td colspan="2"><mark>{{ getFinalEvaluation(review.score) }}</mark></td>
                                </tr>
                            </tbody>

                        </table>

                    </li>
                </ul>
               
            </div>

            <div class="uk-flex uk-flex-center uk-margin-medium" v-else>
                <p>Cargando... <span class="uk-margin-small-left" uk-spinner></span></p>
            </div>
        
        </div>
    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';

    export default {
    
        data () {
            return {
                loading: true.data,
                work: {}
            }
        },
        methods: {
            getEvaluation: function (score) {
                if ( score == 1 ) return 'Aceptable';
                else if ( score == 2 ) return 'Requiere de mejora';
                else if ( score == 3 ) return 'Deficiente';
                else if ( score == 4 ) return 'No la incluye';
            },
            getFinalEvaluation: function (score) {
                if ( score == 1 ) return 'Aceptado';
                else if ( score == 2 ) return 'Aceptado con correcciones menores';
                else if ( score == 3 ) return 'No aceptado';
                else return 'Esperando dictamen';
            }
        },
        created () {

            EventBus.$on('showReviews', (work) => {
                this.work = work;
            });

        }

    }

</script>
