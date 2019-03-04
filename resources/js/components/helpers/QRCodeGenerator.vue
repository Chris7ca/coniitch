<template>
    
    <div id="modal-qr-code" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <h3>Codigo QR</h3>
            <hr class="uk-divider-small">

            <div class="uk-flex uk-flex-center uk-margin-medium-top uk-margin-medium-bottom">
                <qriously :value="data" :size="300"></qriously>
            </div>
            
        </div>
    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';

    export default {
        data () {
            return {
                data: ''
            }
        },
        created () {
                
            EventBus.$on('generateQRCode', data => {
                // Always parsing data
                this.data = JSON.stringify(data);
            });            
        }
    }

</script>