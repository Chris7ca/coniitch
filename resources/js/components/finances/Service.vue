<template>
    
    <div id="modal-service" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h4>Servicios</h4>

            <form class="uk-form-stacked uk-flex-middle uk-margin-medium" @submit.prevent="saveService">

                <div class="uk-margin">
                    <label class="uk-form-label">Concepto</label>
                    <input type="text" class="uk-input" v-model="service.concept" required placeholder="Nombre del servicio o producto">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-lable">Costo</label>
                    <input type="text" class="uk-input" v-model="service.price" required placeholder="$ 00.00 MXN">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Dirigido a</label>
                    <multiselect v-model="selectedRoles" :multiple="true" :searchable="false" label="name" 
                    track-by="value" :options="roles" required placeholder="Selecciona a quienes va dirigido el servico"></multiselect>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Descripción</label>
                    <textarea rows="5" class="uk-textarea" v-model="service.details" required placeholder="Detalles del producto o servicio..."></textarea>
                </div>

                <div class="uk-margin">
                    <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">{{ txtBtnSubmit }}</button>
                </div>

            </form>

        </div>
    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';
    import Multiselect from 'vue-multiselect';
    
    export default {
        components: {
            Multiselect
        },
        data () {
            return {
                loader : false,
                mode : 'create',
                service: {
                    public_id : '',
                    concept   : '',
                    details   : '',
                    price     : '',
                    for_users : []
                },
                discount: null,
                roles : [],
                selectedRoles : []
            }
        },
        computed: {
            txtBtnSubmit: function () {
                return ( this.mode == 'create' ) ? 'Crear servicio' : 'Actualizar servicio';
            }
        },
        watch: {
            selectedRoles: function (roles) {
                this.service.for_users = roles.map( role => ({ public_id: role.value, display_name: role.name }) );
            }
        },
        methods: {
            clearData: function () {
                this.service =  {
                    public_id : '',
                    concept   : '',
                    details   : '',
                    price     : ''
                }
            },  
            saveService: function () {
                
                let url     = route('app.finances.services.save');
                this.loader = true;

                axios.post(url, this.service)
                .then( response => {
                    
                    this.loader = false;
                    
                    if ( this.mode == 'create' ) {
                        this.service.public_id = response.data.public_id;
                        EventBus.$emit('serviceCreated', this.service);
                    } 

                    UIkit.notification(`Servicio ${ (this.mode == 'create') ? 'creado' : 'actualizado' }`, 'success');
                    UIkit.modal('#modal-service').hide();

                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });

            },
        },
        created () {

            axios.post(route('app.root.roles.simple.search'))
            .then( response => {
                response.data.forEach(role => {
                    this.roles.push({ name: role.display_name, value: role.public_id });
                });
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('editService', service => {
                
                this.mode    = 'update';
                this.service = service;

                this.selectedRoles = service.for_users.map( role => ({ name: role.display_name, value: role.public_id }) );

                UIkit.util.on('#modal-service', 'hide', () => {
                    this.mode = 'create';
                    this.clearData();
                    this.selectedRoles = [];
                });

            });

        }
    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>