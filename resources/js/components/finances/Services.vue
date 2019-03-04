<template>

    <div>

        <div class="uk-margin-medium">
            <a href="#modal-service" class="uk-link-reset" uk-toggle>
                <span class="uk-margin-small-right" uk-icon="plus-circle"></span> Nuevo servicio
            </a>
        </div>
    
        <table class="uk-table uk-table-middle uk-table-divider uk-table-responsive uk-margin-large">

            <thead>
                <tr>
                    <th>Servicio</th>
                    <th class="uk-table-expand">Detalles</th>
                    <th>Precio U.</th>
                    <th>Dirigido a</th>
                    <th class="uk-text-center">Opciones</th>
                </tr>
            </thead>

            <tbody>

                <tr v-for="service in services" :key="service.public_id">
                    
                    <td>
                        <h6>{{ service.concept }}</h6>
                    </td>
                    <td>
                        {{ service.details }}
                    </td>
                    <td>
                        $ {{ parseFloat(service.price).toFixed(2) }} MXN
                    </td>
                    <td>
                        <span class="uk-label uk-small" v-for="role in service.for" :key="role.public_id">{{ role.display_name }}</span>
                    </td>
                    <td>
                        <ul class="uk-iconnav uk-flex-center">
                            
                            <li>
                                <a href="#modal-service" uk-icon="file-edit" @click="editService(service)" uk-tooltip="Editar servicio" uk-toggle></a>
                            </li>
                            <li>
                                <a role="button" uk-icon="trash" @click="deleteService(service)" uk-tooltip="Eliminar servicio"></a>
                            </li>
                            <li>
                                <a role="button" uk-icon="tag" uk-tooltip="Descuentos">
                                    <sup v-if="service.discounts.length > 0">
                                        <span class="uk-badge">{{ service.discounts.length }}</span>
                                    </sup>
                                </a>

                                <div uk-dropdown="mode: click">
                                    
                                    <div>
                                        <div v-if="service.discounts.length == 0">
                                            <small>
                                                No hay promociones o descuetos asociados a este servicio
                                            </small>
                                        </div>

                                        <ul class="uk-list uk-list-divider" v-else>
                                            <li v-for="discount in service.discounts" :key="discount.public_id">

                                                <h6 class="uk-margin-remove">{{ discount.name }}</h6>
                                                <span class="uk-text-meta">$ {{ parseFloat(discount.discount).toFixed(2) }} MX</span>

                                                <ul class="uk-iconnav uk-padding-remove">
                                                    <li>
                                                        <a href="#modal-discount" uk-icon="icon: file-edit; ratio: 0.9;" @click="editDiscount(service, discount)" uk-toggle></a>
                                                    </li>
                                                    <li>
                                                        <a role="button" uk-icon="icon: trash; ratio: 0.9;" @click="deleteDiscount(service, discount)"></a>
                                                    </li>
                                                </ul>

                                            </li>
                                        </ul>                                        
                                        
                                        <hr class="uk-divider-small">

                                        <a href="#modal-discount" class="uk-link-reset uk-text-small" @click="createDiscount(service)" uk-toggle>
                                            <span class="uk-margin-small-left" uk-icon="plus-circle"></span> Agregar descuento
                                        </a>
                                    </div>

                                </div>
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

                <tr v-else-if="!loader && services.length == 0">
                    <td class="uk-text-center" colspan="6">
                        <h6>No hay servicios aún...</h6>
                    </td>
                </tr>
                
            </tfoot>

        </table>

    </div>

</template>

<script>
    
    import { EventBus } from './../../bus.js';

    export default {
        data () {
            return {
                loader: true,
                services: []
            }
        },
        methods: {
            editService: function (service) {
                EventBus.$emit('editService', service);
            },
            createDiscount: function (service) {
                EventBus.$emit('createDiscount', service);
            },  
            editDiscount: function (service, discount) {
                EventBus.$emit('editDiscount', service, discount);
            },
            deleteService: function (service) {

                UIkit.modal.confirm('¿Estás seguro que deseas elimiar este servicio? Ten en cuenta que puede haber pagos relacionados.').then(() => {

                    let url = route('app.finances.services.delete', { id : service.public_id });

                    axios.delete(url)
                    .then( response => {

                        let index = this.services.findIndex( s => s.public_id == service.public_id );

                        this.services.splice(index, 1);
                        UIkit.notification(response.data.message, 'success');
                        
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });

                }, () => {});

            },
            deleteDiscount: function (service, discount) {
                UIkit.modal.confirm('¿Estás seguro que deseas elimiar este servicio? Ten en cuenta que puede haber pagos relacionados.').then(() => {

                    let url = route('app.finances.services.discount.delete', { id : service.public_id, ID : discount.public_id});

                    axios.delete(url)
                    .then( response => {

                        let indexService  = this.services.findIndex( s => s.public_id == service.public_id );
                        let indexDiscount = this.services[indexService].discounts.findIndex( d => d.public_id == discount.public_id );
                        
                        this.services[indexService].discounts.splice(indexDiscount, 1);
                        UIkit.notification(response.data.message, 'success');

                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });

                }, () => {});
            }
        },
        created () {

            let url = route('app.finances.services.index');

            axios.post(url)
            .then( response => {
                this.loader = false;
                this.services = response.data;
            })
            .catch( error => {
                this.loader = false;
                showAxiosErrorMessage(error);
            });

            EventBus.$on('serviceCreated', service => {
                this.services.push(service);
            });

            EventBus.$on('discountCreated', (id, discount) => {

                let index = this.services.findIndex( s => s.public_id == id );

                this.services[index].discounts.push(discount);

            });

        }
    }

</script>
