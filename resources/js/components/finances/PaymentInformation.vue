<template>
    
    <div id="payment-information" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-position-relative">

            <div class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle" v-if="loader">
                <h6>Cargando... <span uk-spinner="ratio: 0.8"></span></h6>
            </div>

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h3>{{ payment.service.concept }}</h3>
            <hr class="uk-divider-small">

            <ul class="uk-list uk-margin-medium-top">
                <li>Fecha de pago: <b>{{ payment.created_at }}</b></li>
                <li>Referencia de pago: <b>{{ payment.transaction_id }}</b></li>
                <li>Nombre del congresista: <b>{{ payment.user.first_name + ' ' + payment.user.last_name }}</b></li>
                <li>Concepto: <b>{{ payment.service.concept.toLowerCase() }}</b></li>
                <li>Monto: <b>$ {{ payment.amount.toFixed(2) }}</b></li>
                <li>Método de pago: <b>{{ payment.method.toUpperCase() }}</b></li>
                <li>Requiere factura: <b>{{ (payment.required_invoice) ? 'Sí' : 'No' }}</b></li>
            </ul>

            <ul uk-accordion v-if="payment.required_invoice">
                <li>
                    <a class="uk-accordion-title" role="button"><h6>Datos fiscales</h6></a>

                    <div class="uk-accordion-content">
                        <ul class="uk-list">
                            <li>Régimen fiscal: <b>{{ invicing_data.type }}</b></li>
                            <li>Nombre o razón social: <b>{{ invicing_data.display_name }}</b></li>
                            <li>RFC: <b>{{ invicing_data.rfc }}</b></li>
                            <li>País: <b>{{ invicing_data.country }}</b></li>
                            <li>Código postal: <b>{{ invicing_data.zip_code }}</b></li>
                            <li>Dirección: <b>{{ invicing_data.address }}, C.P. {{ invicing_data.zip_code }}. {{ invicing_data.city }}, {{ invicing_data.state }}.</b></li>
                        </ul>
                    </div>
                </li>
            </ul>

            <div class="uk-margin-medium-top">
                
                <a :href="payment.voucher.replace('public','/storage')" class="uk-button button-text uk-padding-remove" target="_blank" v-if="payment.voucher">
                    Descargar comprobante de pago <span class="uk-margin-small-left" uk-icon="download"></span>
                </a>

                <br>

                <a role="button" class="uk-button button-text uk-padding-remove" @click="aprovePayment" v-if="!payment.status">
                    Aprovar pago <span class="uk-margin-small-left" uk-icon="check"></span>
                </a>

            </div>
            
        </div>
    </div>
    
</template>

<script>

    import { EventBus } from './../../bus.js';

    export default {
        data () {
            return {
                loader: false,
                payment: {
                    public_id: '',
                    method: '',
                    transaction_id: '',
                    created_at: '',
                    required_invoice: '',
                    voucher: '',
                    amount: 0,
                    user: {
                        first_name: '',
                        last_name: ''
                    },
                    service: {
                        public_id: '',
                        concept: ''
                    },

                },
                invicing_data: {
                    type: '',
                    display_name: '',
                    rfc: '',
                    country: '',
                    zip_code: '',
                    state: '',
                    city: '',
                    address: ''
                }
            }
        },
        watch:{
            payment: function (value) {
                
                if ( value.required_invoice ) {

                    let url = route('app.finances.payments.invoicing.data', { id : this.payment.user.public_id });

                    axios.post(url)
                    .then( response => {
                        this.invicing_data = response.data;
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    })

                }
            }
        },
        methods: {
            aprovePayment: function () {
                
                let url = route('app.finances.payments.confirmation', { id : this.payment.public_id });
                this.loader = true;

                axios.post(url)
                .then( response => {

                    this.loader = false;
                    this.payment.status = true;

                    UIkit.modal('#payment-information').hide();
                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });

            }
        },
        created () {
            
            EventBus.$on('paymentInformation', payment => {
                this.payment = payment;
            });

        }
    }
    
</script>
