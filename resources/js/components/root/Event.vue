<template>
    
    <div id="modal-event" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <form class="uk-form-stacked uk-flex-middle" @submit.prevent="saveEvent">

                <div class="uk-margin">
                    <label class="uk-form-label">Nombre del evento / actividad</label>
                    <input type="text" class="uk-input" v-model="event.name" placeholder="Requerido" required>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Descripción</label>
                    <textarea v-model="event.description" class="uk-textarea" rows="10" maxlength="255" placeholder="Requerido" required></textarea>
                </div>
                
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-box-shadow-hover-large">
                        {{ ( mode == 'create' ) ? 'Crear actividad' : 'Actualizar información' }}
                        <span class="uk-margin-small-right" uk-spinner="ratio: 0.8;" v-if="loader"></span>
                    </button>
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
                mode: 'create',
                event: {
                    public_id: '',
                    name: '',
                    description: '',
                }
            }
        },
        methods: {
            clearData: function () {
                this.mode = 'create';
                this.event = {
                    public_id: '',
                    name: '',
                    description: '',
                };
            },
            saveEvent: function () {

                let url = route('app.root.events.save');
                this.loader = true;

                axios.post(url, this.event)
                .then( response => {
                    
                    this.loader = false;

                    if ( this.mode == 'create' ){
                        EventBus.$emit('eventCreated', response.data);
                    }

                    UIkit.modal('#modal-event').hide();

                    UIkit.util.on('#modal-event', 'hide', () => {
                        this.clearData();
                    });
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created () {
            
            EventBus.$on('editEvent', event => {
                this.event = event;
                this.mode = 'update';

                UIkit.util.on('#modal-event', 'hide', () => {
                    this.clearData();
                });
            });
        }
    }

</script>