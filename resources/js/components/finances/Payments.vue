<template>
    
    <div>
        
        <div class="uk-text-right">
            <h6>Balance total: $ {{ total.toFixed(2) }}</h6>
        </div>

        <pagination :url="route('app.finances.payments.index')" @updateItems="updateItems" @updateLoader="updateLoader"></pagination>

        <table class="uk-table uk-table-divider uk-table-middle uk-table-responsive">

            <thead>
                <th class="uk-table-shrink"></th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Método</th>
                <th>Congresista</th>
                <th class="uk-text-center">Acciones</th>
            </thead>

            <tbody>

                <tr v-for="(payment, index) in payments" :key="index">
                    <td>
                        <span class="uk-badge badge-success" uk-tooltip="Pago válidado" v-if="payment.status">V</span>
                        <span class="uk-badge badge-warning" uk-tooltip="Esperando validación de pago" v-else>E</span>
                    </td>
                    <td>
                        <h6>{{ payment.service.concept }}</h6>
                    </td>
                    <td>
                        $ {{ payment.amount.toFixed(2) }}
                    </td>
                    <td>
                        {{ payment.method }}
                    </td>
                    <td>
                        <a href="#modal-profile" class="uk-button uk-padding-remove" @click="showProfile(payment.user.public_id)" uk-toggle>{{ payment.user.first_name + ' ' + payment.user.last_name }}</a>
                    </td>
                    <td>
                        <ul class="uk-iconnav uk-flex uk-flex-center">
                            <li>
                                <a href="#payment-information" uk-tooltip="Ver más información" @click="paymentInformation(payment)" uk-icon="eye" uk-toggle></a>
                            </li>
                        </ul>
                    </td>
                </tr>

            </tbody>

            <tfoot>

                <tr v-if="loader">
                    <td class="uk-text-center" colspan="6">
                        Cargando datos... <span class="uk-margin-small-left" uk-spinner="ratio:0.8"></span>  
                    </td>
                </tr>

                <tr v-else-if="!loader && payments.length == 0">
                    <td class="uk-text-center" colspan="6">
                        <h6>No hay pagos realizados aún ...</h6>
                    </td>
                </tr>

            </tfoot>

        </table>

    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';
    import Pagination from './../helpers/Pagination.vue';

    export default {
        components:{
            Pagination
        },
        data () {
            return {
                loader: true,
                payments: []
            }
        },
        computed: {
            total: function () {
                
                let total = 0;

                this.payments.map( payment => { 

                    if ( payment.status )
                        total += payment.amount;

                });

                return total;
            }
        },
        methods: {
            paymentInformation: function (payment) {
                EventBus.$emit('paymentInformation', payment);  
            },
            showProfile: function (id) {
                EventBus.$emit('showProfile', id);
            },
            updateItems: function (payments) {
                this.payments = payments;
            },
            updateLoader: function (status) {
                this.loader = status;
            }
        }
    }

</script>
