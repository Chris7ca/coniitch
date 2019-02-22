<template>
    
    <div id="modal-discount" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h4>Promociones y descuentos</h4>

            <form class="uk-form-stacked uk-flex-middle uk-margin-medium" @submit.prevent="saveDiscount">

                <div class="uk-margin">
                    <label class="uk-form-label">Nombre del la promoción</label>
                    <input type="text" class="uk-input" v-model="discount.name" required placeholder="Nombre de la promoción o descuento">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Fin de la promoción</label>
                    <flat-pickr class="uk-input" v-model="discount.end_date" required placeholder="aa/mm/dd"></flat-pickr>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-lable">Descueto</label>
                    <input type="text" class="uk-input" v-model="discount.discount" required placeholder="$ 00.00 MXN">
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label">Detalles</label>
                    <textarea rows="5" class="uk-textarea" v-model="discount.details" required placeholder="Detalles de la promoción o descuento"></textarea>
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
    import flatPickr from 'vue-flatpickr-component';  
    import 'flatpickr/dist/flatpickr.css';

    export default {
        components: {
            flatPickr
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
                    end_date: ''
                }
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
                    end_date: ''
                }
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

                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created () {

            EventBus.$on('createDiscount', service => {

                this.public_id = service.public_id;

            });

            EventBus.$on('editDiscount', service => {
                
                this.mode      = 'update';
                this.public_id = service.public_id;
                this.discount  = service.discount;

                UIkit.util.on('#modal-discount', 'hide', () => {
                    this.mode = 'create';
                    this.clearData();
                });

            });

        }
    }

</script>