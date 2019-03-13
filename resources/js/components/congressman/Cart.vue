<template>
    
    <div>

        <h4>Resumen de pago</h4>

        <div v-if="loader">
            Cargando... <span uk-spinner="ratio: 0.8"></span>
        </div>

        <small v-else-if="!loader && cart.length == 0">
            No hay productos o servicios por pagar
        </small>

        <ul class="uk-list uk-list-divider uk-margin-medium-top uk-margin-medium-bottom" v-else>

            <li v-for="(item, index) in cart" :key="index">
                <div class="uk-grid-small uk-child-width-1-2" uk-grid>

                    <div class="uk-text-truncate">
                        {{ item.service.concept }}
                    </div>

                    <div class="uk-text-right">
                        $ {{ getPrice(item.service) }}
                        <a role="button" @click="removeItem(index, item)" uk-icon="close" uk-tooltip="Eliminar item"></a>
                    </div>

                </div>
            </li>

            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand" uk-leader>Total</div>
                    <div>$ {{ total }}</div>
                </div>
            </li>

        </ul>

        <div class="uk-margin uk-width-1-1" v-if="cart.length > 0">
            <label uk-tooltip="Deberá haber completado sus datos fiscales en el menú EDITAR PEFIL">
                <input type="checkbox" class="uk-checkbox" id="invoiceInput"> Requiero factura
            </label>
        </div>
        
        <div class="uk-margin uk-width-1-1" v-if="requiredTranslate">
            <label uk-tooltip="Algunos de tus servicios están completa o parcialmente en inglés, ¿requieres de un dispositivo de traduccion simultanea?">
                <input type="checkbox" class="uk-checkbox" id="translate"> Traducción
            </label>
        </div>

        <div id="paypal-button" v-show="cart.length > 0"></div>

    </div>

</template>

<script>
    
    import { EventBus } from './../../bus.js';

    export default {
        data () {
            return {
                loader: true,
                cart: [],
            }
        },
        computed: {
            total: function () {
                
                let total = 0;

                this.cart.map( item => {

                    total += parseFloat(item.service.price);

                    if ( item.service.discounts.length > 0 ) {

                        item.service.discounts.forEach( discount => {
                            total -= discount.discount;
                        });
                    }
                });

                return total.toFixed(2);
            },
            requiredTranslate: function () {

                let index = this.cart.findIndex( item => item.service.required_translate == true );

                return (index >= 0) ? true : false;
            }
        },
        methods: {
            removeItem: function (index, item) {

                this.loader = true;
            
                axios.delete(route('app.congressman.payments.delete.cart', { id : item.public_id }))
                .then( response => {

                    this.loader = false;
                    this.cart.splice(index, 1);
                    EventBus.$emit('removedItemToCart', item.service.public_id);

                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                })
            },
            getPrice: function (service) {

                let price = service.price;
                
                if ( service.discounts.length > 0 ) {
                    service.discounts.forEach(discount => {
                        price -= discount.discount;
                    });
                } 

                return price.toFixed(2);
            }
        },
        created () {

            axios.post(route('app.congressman.payments.cart'))
            .then( response => {
                
                this.loader = false;
                this.cart = response.data;
                
                EventBus.$emit('loadedCart', response.data);
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('addToCart', service => {
                
                let url = route('app.congressman.payments.add.cart');

                axios.post(url, { service_id : service.public_id })
                .then( response => {

                    this.cart.push({ public_id : response.data.public_id, service: service });
                })
                .catch( error => {
                    showAxiosErrorMessage(error);
                }); 

            });

        },
        mounted () {

            let token = document.head.querySelector('meta[name="csrf-token"]');

            paypal.Button.render({
                env: 'sandbox', // Or 'production',
                locale: 'es_MX',
                style: {
                    size: 'medium',
                    color: 'blue',
                    shape: 'pill',
                    label: 'pay'
                },
                // Set up the payment:
                // 1. Add a payment callback
                payment: function(data, actions) {
                // 2. Make a request to your server
                    return actions.request({
                        method: 'POST',
                        url: route('app.congressman.payments.create'),
                        headers: {
                            'X-CSRF-TOKEN': token.content
                        }
                    })
                    .then(function(res) {
                        // 3. Return res.id from the response
                        // console.log(res);
                        return res.id;
                    });
                },
                // Execute the payment:
                // 1. Add an onAuthorize callback
                onAuthorize: function(data, actions) {
                    // 2. Make a request to your server
                    return actions.request({
                        method: 'POST',
                        url: route('app.congressman.payments.execute'),
                        headers: {
                            'X-CSRF-TOKEN': token.content
                        },
                        json: {
                            paymentID: data.paymentID,
                            payerID:   data.payerID,
                            invoice: document.getElementById('invoiceInput').checked,
                            translate: document.getElementById('translate').checked
                        }
                    })
                    .then(function(res) {
                        // 3. Check if exists errors
                        if (res.error === 'INSTRUMENT_DECLINED') {
                            return actions.restart();
                        }
                        // console.log(res);
                        UIkit.notification('Se ha realizado el pago de manera satisfactoria', 'success');
                        setTimeout(() => {
                            window.location = route('app.congressman.payments.view');
                        }, 900);
                    });
                },
                onCancel: function (data, actions) {
                    UIkit.notification('Ha cancelado el pago', 'warning');
                },
                onError: function (err) {
                    // console.log(err)
                    UIkit.notification('Ocurrio un error en el servidor, por favor contacte al administrador', 'danger');
                }
            }, '#paypal-button');
        }
    }

</script>