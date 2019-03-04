<template>
    
    <div>

        <p class="uk-text-meta"><b>Datos de facturación.</b> Estos datos son requeridos en caso de que requiera factura al momento de realizar algún pago.</p>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading/>
            <content-placeholders-text :lines="4"/>
        </content-placeholders>

        <form @submit.prevent="saveData" v-if="dataLoaded" class="uk-grid uk-form-stacked uk-margin-medium-top" uk-grid>

            <div class="uk-width-1-1">
                <label class="uk-form-label">Tipo de persona</label>
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label><input class="uk-radio" type="radio" v-model="type" value="Moral" name="type"> Persona Moral</label>
                    <label><input class="uk-radio" type="radio" v-model="type" value="Física" name="type"> Persona Física</label>
                </div>
            </div>

            <div class="uk-width-1-1">
                <label class="uk-form-label">Nombre Completo / Razón social</label>
                <input type="text" class="uk-input" v-model="displayName" required placeholder="Requerido">
            </div>

            <div class="uk-width-1-2@m">
                <label class="uk-form-label">RFC</label>
                <input type="text" class="uk-input" v-model="rfc" required placeholder="Requerido">
            </div>

            <div class="uk-width-1-2@m">
                <label class="uk-form-label">País</label>
                <input type="text" class="uk-input" v-model="country" required placeholder="Requerido">
            </div>

            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Código postal</label>
                <input type="text" class="uk-input" v-model="zipCode" required placeholder="Requerido">
            </div>

            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Estado</label>
                <input type="text" class="uk-input" v-model="state" required placeholder="Requerido">
            </div>

            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Ciudad</label>
                <input type="text" class="uk-input" v-model="city" required placeholder="Requerido">
            </div>

            <div class="uk-width-1-2@m">
                <label class="uk-form-label">Dirección</label>
                <input type="text" class="uk-input" v-model="address" required placeholder="Requerido">
            </div>

            <div class="uk-width-1-1">
                <button class="uk-button uk-button-default rounded-button" type="submit">Actualizar Información</button>
            </div>

        </form>

    </div>

</template>

<script>


    
    export default {
        data () {
            return {
                dataLoaded: false,
                type: '',
                displayName: '',
                rfc: '',
                country: '',
                zipCode: '',
                state: '',
                city: '',
                address: ''
            }
        },
        methods: {
            getData: function() {
                return {
                    type         : this.type,
                    display_name : this.displayName,
                    rfc          : this.rfc,
                    country      : this.country,
                    zip_code     : this.zipCode,
                    state        : this.state,
                    city         : this.city,
                    address      : this.address,
                }
            },
            saveData: function() {

                let data = this.getData();
                this.dataLoaded = false;

                axios.post(route('app.congressman.invoicing.update'), data)
                .then( response => {
                    this.dataLoaded = true;
                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created () {

            axios.post(route('app.congressman.invoicing.edit'))
            .then( information => {

                let data = information.data;

                this.type        = (data.invoicing_data) ? data.invoicing_data.type : '';
                this.displayName = (data.invoicing_data) ? data.invoicing_data.display_name : '';
                this.rfc         = (data.invoicing_data) ? data.invoicing_data.rfc : '';
                this.country     = (data.invoicing_data) ? data.invoicing_data.country : '';
                this.zipCode     = (data.invoicing_data) ? data.invoicing_data.zip_code : '';
                this.state       = (data.invoicing_data) ? data.invoicing_data.state : '';
                this.city        = (data.invoicing_data) ? data.invoicing_data.city : '';
                this.address     = (data.invoicing_data) ? data.invoicing_data.address : '';
                this.dataLoaded  = true;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });  

        }
    }

</script>