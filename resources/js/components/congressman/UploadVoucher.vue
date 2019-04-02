<template>
    
    <div id="upload-voucher" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-position-relative" style="overflow: hidden;">

            <div class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle" v-if="loader">
                <h6>Cargando... <span uk-spinner="ratio: 0.8"></span></h6>
            </div>

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h3>Enviar recibo de pago</h3>
            <h5 class="uk-text-muted uk-margin-remove">{{ service.concept }}</h5>
            <hr class="uk-divider-small">

            <form class="uk-form-stacked" @submit.prevent="uploadVoucher">

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">Referencia de pago</label>
                    <input type="text" class="uk-input" v-model="reference" placeholder="7 dígitos" required>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">Monto</label>
                    <input type="number" class="uk-input" v-model="amount" placeholder="00.00" required>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">Método de pago</label>
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                        <label><input class="uk-radio" type="radio" v-model="method" name="method" value="Déposito bancario"> Déposito bancario</label>
                        <label><input class="uk-radio" type="radio" v-model="method" name="method" value="Transferencia bancaria"> Transferencia bancaria</label>
                    </div>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label type="file" class="uk-button" for="input-voucher">
                        <span class="uk-margin-small-right" uk-icon="cloud-upload"></span> Adjuntar comprobante de pago
                    </label>
                    <input type="file" id="input-voucher" @change="uploadFile" required hidden>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label uk-tooltip="Deberá haber completado sus datos fiscales en el menú EDITAR PEFIL">
                        <input type="checkbox" class="uk-checkbox" v-model="invoice"> Requiero factura
                    </label>
                </div>

                <div class="uk-margin uk-width-1-1" v-if="service.required_translate">
                    <label uk-tooltip="Este servicio incluye contenido que está completa o parcialmente en inglés, ¿requieres de un dispositivo de traduccion simultanea?">
                        <input type="checkbox" class="uk-checkbox" v-model="required_translate"> Dispositivo de traducción 
                    </label>
                </div>

                <div class="uk-margin-medium uk-width-1-1">
                    <button type="submit" class="uk-button uk-button-default">Enviar comprobante</button>
                </div>

            </form>
            
        </div>
    </div>

</template>

<script>

    import {EventBus} from './../../bus.js';

    export default {
        data () {
            return {
                service: {
                    concept: '',
                    required_translate: false
                },
                loader: false,
                reference: '',
                method: '',
                amount: '',
                required_translate: false,
                invoice: false
            }
        },
        methods: {
            uploadFile: function () {

                let file = document.getElementById('input-voucher').files[0];
                let ext = this.getExtension(file.name);

                if ( ext != 'pdf' ){

                    event.target.files[0].value = null;
                    UIkit.notification('El tipo de archivo aceptado debe ser PDF', 'warning');

                }
            },
            getExtension: function (path) {
                
                let basename = path.split(/[\\/]/).pop();
                let pos = basename.lastIndexOf('.');

                if (basename === '' || pos < 1) {
                    return '';
                }
                return basename.slice(pos + 1);
            },
            uploadVoucher: function () {
                
                this.loader = true;
                let data = new FormData();
                let url  = route('app.congressman.payments.services.voucher', { id : this.service.public_id });

                data.append('reference', this.reference);
                data.append('method',    this.method);
                data.append('amount',    this.amount);
                data.append('invoice',   this.invoice);
                data.append('required_translate',   this.required_translate);
                data.append('voucher',   document.getElementById('input-voucher').files[0]);

                axios.post(url, data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response => {

                    this.loader = false;

                    UIkit.modal('#upload-voucher').hide();
                    EventBus.$emit('voucherUploaded', response.data);
                    UIkit.notification('Hemos registrado su pago, en breve se válidará el mismo y se le notificará el estatus de aprobación', 'success');
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });
                
            }
        },
        created () {

            EventBus.$on('uploadVoucher', service => {
                this.service = service;
            });

        }
    }

</script>
