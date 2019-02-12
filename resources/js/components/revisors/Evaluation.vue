<template>
    
    <div id="modal-evaluation" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-width-4-5">
            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h3>Evaluación de trabajos</h3>
            <hr class="uk-divider-small">

            <div v-if="work != null && !loading">
                <h3 class="uk-margin-remove">{{ work.title }}</h3>
                <span>{{ work.adscription_work }}</span>

                <ul class="uk-subnav uk-subnav-divider uk-uk-margin-small-bottom">
                    <li><span>{{ (work.type == 'Banner') ? 'Cartel' : 'Oral' }}</span></li>
                    <li><span>{{ (work.axis == 'Research') ? 'Investigación' : 'Teórico' }}</span></li>
                    <li><span>{{ (work.theme == 'Transdiscipline') ? 'Transdisciplina' : 'Salud y sociedad' }}</span></li>
                </ul>

                <form id="form-evaluation" class="uk-form-stacked uk-flex-middle" @submit.prevent="evaluateWork">
                    
                    <div class="uk-margin-medium-top" v-for="(evaluation, index) in work.reviews[0].evaluations" :key="index">

                        <h4 class="uk-margin-remove">
                            <label class="uk-text-primary">{{ evaluation.criteria.title }}</label>
                        </h4>
                        <small>{{ evaluation.criteria.description }}</small>

                        <div class="uk-grid uk-flex-middle uk-flex-between uk-margin" uk-grid>
                            <label class="uk-text-small">
                                <input class="uk-radio" type="radio" value="1" v-model="evaluation.score" :name="'criteria_'+index" required> Aceptable
                            </label>
                            <label class="uk-text-small">
                                <input class="uk-radio" type="radio" value="2" v-model="evaluation.score" :name="'criteria_'+index" required> Requiere mejora
                            </label>
                            <label class="uk-text-small">
                                <input class="uk-radio" type="radio" value="3" v-model="evaluation.score" :name="'criteria_'+index" required> Deficiente
                            </label>
                            <label class="uk-text-small">
                                <input class="uk-radio" type="radio" value="4" v-model="evaluation.score" :name="'criteria_'+index" required> No la incluye
                            </label>
                        </div>

                    </div>

                    <div class="uk-margin-medium-top">

                        <h4 class="uk-margin-remove">
                            <label class="uk-text-primary">Dictamen</label>
                        </h4>

                        <div class="uk-grid uk-flex-middle uk-flex-between uk-margin" uk-grid>
                            <label>
                                <input class="uk-radio" type="radio" value="1" v-model="work.reviews[0].score" name="note" required> Aceptado
                            </label>
                            <label v-if="work.version == 1">
                                <input class="uk-radio" type="radio" value="2" v-model="work.reviews[0].score" name="note" required> Aceptado con correcciones menores
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" value="3" v-model="work.reviews[0].score" name="note" required> No aceptado
                            </label>
                        </div>

                    </div>

                    <div class="uk-margin-medium-top">

                        <h4 class="uk-margin-remove">
                            <label class="uk-text-primary">Justificación</label>
                        </h4>

                        <textarea rows="10" v-model="work.reviews[0].feedback" class="uk-textarea" placeholder="Justificación del dictamen" required></textarea>

                    </div>

                    <div class="uk-margin-medium-top">
                        <button class="uk-button uk-button-primary uk-box-shadow-hover-medium" type="submit">Evaluar</button>
                    </div>

                </form>
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
                loading : false,
                work    : null,
            }
        },
        methods: {
            evaluateWork: function () {
                
                this.loading = true;
                let url      = route('app.revisors.works.evaluate', { id : this.work.public_id });
                let data     = this.work.reviews[0];

                axios.post(url, data)
                .then( response => {

                    this.loading = false;
                    this.work.reviews[0] = response.data;

                    // EventBus.$emit('workEvaluated', this.work.public_id, data);
                    UIkit.modal('#modal-evaluation').hide();
                    UIkit.notification('Evaluación completada, se notificará al administrador', 'success');
                })
                .catch( error => {

                    this.loading = false;

                    showAxiosErrorMessage(error);
                });

            }
        },
        created () {

            EventBus.$on('evaluateWork', (work) => {
                
                let url      = route('app.revisors.works.criterias');
                this.work    = work;

                if ( work.reviews.length == 0 ) {

                    this.loading = true;

                    axios.post(url, { axis : work.axis })
                    .then( response => {

                        this.loading = false;
                        let evaluations = [];

                        response.data.forEach( criteria => {
                            evaluations.push({
                                public_id: null,
                                score: null,
                                criteria: {
                                    description: criteria.description,
                                    public_id: criteria.public_id,
                                    title: criteria.title
                                }
                            });
                        });

                        this.work.reviews.push({
                            public_id: null,
                            score: null,
                            feedback: '',
                            evaluations: evaluations
                        });

                    })
                    .catch( error => {
                        this.loading = false;
                        showAxiosErrorMessage(error);
                    });

                }

            });

        }

    }

</script>
