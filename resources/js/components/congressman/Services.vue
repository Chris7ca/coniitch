<template>
    
    <ul class="uk-list uk-list-divider">

        <li v-if="loader">
            Cargando ... <span class="uk-margin-small-left" uk-spinner="ratio: 0.8"></span>
        </li>

        <li v-else-if="!loader && services.length == 0">
            No hay servicios disponibles ...
        </li>

        <li v-for="(service, index) in services" :key="index">
            <div class="uk-padding">
                
                <h4>{{ service.concept }}</h4>

                <p>{{ service.details }}</p>

                <ul class="uk-list  uk-margin-medium-top">

                    <li>
                        <span class="uk-margin-small-right" uk-icon="tag"></span> <b>{{ getPrice(service) }}</b>{{ (service.discounts.length > 0) ? `, antes $ ${service.price.toFixed(2)} MXN` : '' }}
                    </li>

                    <li>
                        <span class="uk-margin-small-right" uk-icon="credit-card"></span>
                        <a href="#modal-payment-methods" uk-toggle>Métodos de pago</a>
                    </li>

                    <li v-if="service.discounts.length > 0">
                        <span class="uk-margin-small-right" uk-icon="info"></span>
                        <a role="button" class="uk-link-reset">Promociones</a>
                        <div uk-dropdown>
                            <ul class="uk-list uk-list-divider uk-padding-remove">
                                <li v-for="discount in service.discounts" :key="discount.public_id">
                                    <h6 class="uk-margin-remove">{{ discount.name }}</h6>
                                    <small> - $ {{ discount.discount.toFixed(2) }} MXN</small>

                                    <p class="uk-text-small" v-if="diffInDays(discount.end_date) > 7">
                                        Válido hasta el {{ discount.end_date }}
                                    </p>

                                    <p class="uk-text-warning uk-text-small" v-if="diffInDays(discount.end_date) <= 7 && diffInDays(discount.end_date) >= 1">
                                        Solo quedan {{ Math.ceil(diffInDays(discount.end_date)) }} días de precio especial
                                    </p>

                                    <p class="uk-text-danger uk-text-small" v-if="diffInDays(discount.end_date) < 1">
                                        Solo quedan 
                                        <b :uk-countdown="`date: ${discount.end_date}`">
                                            <span class="uk-countdown-hours"></span> horas,
                                            <span class="uk-countdown-minutes"></span> minutos,
                                            <span class="uk-countdown-seconds"></span> segundos
                                        </b>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="uk-margin-medium-top" v-if="service.images.length > 0">
                        <div class="uk-grid uk-grid-middle" uk-grid uk-lightbox="animation: slide">
                            <div v-for="image in service.images" :key="image.public_id">
                                <div class="uk-box-shadow-medium uk-box-shadow-hover-large">
                                    <a class="uk-inline service-image" :href="image.file.replace('public','/storage')">
                                        <img :src="image.file.replace('public','/storage')">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                
                </ul>

                <div class="uk-text-right uk-margin-medium-top" v-if="existsPayment(service)">
                    
                    <h6 class="uk-text-primary" v-html="statusPayment(service)"></h6>

                </div>

                <div class="uk-text-right uk-margin-medium-top" v-else-if="!existsInCart(service)">
                    
                    <a href="#upload-voucher" class="uk-button" @click="uploadVoucher(service)" uk-toggle>
                        <span class="uk-margin-small-right" uk-icon="cloud-upload"></span> Enviar comprobante de pago
                    </a>

                    <a role="button" class="uk-button" @click="addToCart(service)" uk-tooltip="Seleccione agregar si desea realizar pagos con Paypal">
                        <span class="uk-margin-small-right" uk-icon="cart"></span> Agregar
                    </a>

                </div>

            </div>
        </li>

    </ul>

</template>

<script>
    
    import { EventBus } from './../../bus.js';

    export default {
        data () {
            return {
                loader: true,
                services: [],
                payments: [],
                cart: []
            }
        },
        methods: {
            diffInDays: function (end_date) {
                
                let now   = new Date();
                let array = end_date.substring(0, 10).split('-');
                let date  = new Date(array[0], (array[1] - 1), array[2], 23, 59, 59);

                return ((date.getTime() - now.getTime()) / 1000 / 60 / 60 / 24);     
            },
            getPrice: function (service) {

                let price = service.price;
                
                if ( service.discounts.length > 0 ) {
                    service.discounts.forEach(discount => {
                        price -= discount.discount;
                    });
                } 

                return `$ ${ price.toFixed(2) } MXN`;
            },
            existsInCart: function (service) {

                return (this.cart.find( item => item.service.public_id == service.public_id )) != undefined;
            },
            existsPayment: function (service) {

                return (this.payments.find( item => item.service_id == service.public_id )) != undefined;
            },
            statusPayment: function (service) {
                
                let payment = this.payments.filter( item => item.service_id == service.public_id)[0];
                
                return (payment.status) ? '<span class="uk-margin-small-right" uk-icon="check"></span> Pagado' : '<span class="uk-margin-small-right" uk-icon="clock"></span> Esperando validación de pago';
            },
            addToCart: function (service) {

                EventBus.$emit('addToCart', service);
            },
            uploadVoucher: function (service) {
                EventBus.$emit('uploadVoucher', service);
            }
        },
        created () {

            axios.post(route('app.congressman.payments.services'))
            .then( response => {
                this.loader = false;
                this.services = response.data.services;
                this.payments = response.data.payments;
            })
            .catch( error => {
                this.loader = false;
                showAxiosErrorMessage(error);
            });

            EventBus.$on('loadedCart', cart => {
                this.cart = cart;
            });

            EventBus.$on('voucherUploaded', payment => {
                this.payments.push(payment);
            });

        }
    }

</script>