<template>
    
    <div id="modal-discount" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h4>Promociones y descuentos</h4>

            <form class="uk-form-stacked uk-flex-middle uk-margin-medium" @submit.prevent="saveDiscount">

                <div class="uk-margin">
                    <label class="uk-form-label">Nombre de la promoción</label>
                    <input type="text" class="uk-input" v-model="discount.name" required placeholder="Nombre de la promoción o descuento">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Fin de la promoción</label>
                    <flat-pickr class="uk-input" v-model="discount.end_date" required placeholder="aa/mm/dd"></flat-pickr>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-lable">Descuento</label>
                    <input type="number" class="uk-input" v-model="discount.discount" required placeholder="$ 00.00 MXN">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Dirigido a</label>
                    <multiselect v-model="selectedRoles" :multiple="true" :searchable="false" label="name" 
                    track-by="value" :options="roles" required placeholder="Selecciona a quienes va dirigido el servicio"></multiselect>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Detalles</label>
                    <textarea rows="5" class="uk-textarea" v-model="discount.details" required placeholder="Detalles de la promoción o descuento"></textarea>
                </div>

                <div class="uk-margin">
                    <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large" :disabled="loader">
                        {{ txtBtnSubmit }} <span class="uk-margin-small-right" uk-spinner="ratio: 0.8" v-if="loader"></span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';
    import flatPickr from 'vue-flatpickr-component';
    import Multiselect from 'vue-multiselect';
    import 'flatpickr/dist/flatpickr.css';

    export default {
        components: {
            flatPickr, Multiselect
        },
        data () {
            return {
                loader: false,
                mode: 'create',
                public_id : '',
                discount: {
                    public_id: null,
                    name: '',
                    details: '',
                    discount: '',
                    end_date: '',
                    for : []
                },
                roles : [],
                selectedRoles : []
            }
        },
        watch: {
            selectedRoles: function (roles) {
                this.discount.for = roles.map( role => ({ public_id: role.value, display_name: role.name }) );
            }
        },
        computed: {
            txtBtnSubmit: function () {
                return (this.mode == 'create') ? 'Crear promoción' : 'Actualizar promoción';
            }
        },
        methods: {
            clearData: function () {
                this.discount = {
                    public_id: null,
                    name: '',
                    details: '',
                    discount: '',
                    start_date: '',
                    end_date: '',
                    for : []
                }
                this.public_id = '';
                this.selectedRoles = [];
                this.mode = 'create';
            },
            saveDiscount: function () {
                
                let url     = route('app.finances.services.discount', { id : this.public_id });
                this.loader = true;

                axios.post(url, this.discount)
                .then( response => {
                    
                    this.loader = false;
                    
                    if ( this.mode == 'create' ) {
                        EventBus.$emit('discountCreated', this.public_id, response.data);
                    }

                    UIkit.notification(`Promoción ${ (this.mode == 'create') ? 'creada' : 'actualizada' }`, 'success');
                    UIkit.modal('#modal-discount').hide();

                    UIkit.util.on('#modal-discount', 'hide', () => {
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

            axios.post(route('app.root.roles.simple.search'))
            .then( response => {
                response.data.forEach(role => {
                    this.roles.push({ name: role.display_name, value: role.public_id });
                });
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('createDiscount', service => {

                this.public_id = service.public_id;

            });

            EventBus.$on('editDiscount', (service, discount) => {
                
                this.mode      = 'update';
                this.public_id = service.public_id;
                this.discount  = discount;

                this.selectedRoles = discount.for.map( role => ({ name: role.display_name, value: role.public_id }) );

                UIkit.util.on('#modal-discount', 'hide', () => {
                    this.clearData();
                });

            });

        }
    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>