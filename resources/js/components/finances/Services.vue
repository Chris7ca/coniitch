<template>

    <div>

        <div class="uk-margin-medium">
            <a href="#modal-service" class="uk-link-reset" uk-toggle>
                <span class="uk-margin-small-left" uk-icon="plus-circle"></span> Nuevo servicio
            </a>
        </div>
    
        <table class="uk-table uk-table-middle uk-table-divider uk-table-responsive uk-margin-large">

            <thead>
                <tr>
                    <th>Servicio</th>
                    <th class="uk-table-expand">Detalles</th>
                    <th class="uk-table-shink">Precio U.</th>
                    <th class="uk-table-shink">Dirigido a</th>
                    <th class="uk-text-center">Opciones</th>
                </tr>
            </thead>

            <tbody>

                <tr v-for="(service, index) in services" :key="index">
                    
                    <td>
                        {{ service.concept }}
                    </td>
                    <td>
                        {{ service.details }}
                    </td>
                    <td>
                        $ {{ service.price }} MXN
                    </td>
                    <td>
                        <small class="uk-label uk-margin-small-left" v-for="(user, i) in service.for_users" :key="i">
                            {{ user.display_name }}
                        </small> 
                    </td>
                    <td>
                        <ul class="uk-iconnav uk-flex-center">
                            
                            <li>
                                <a href="#modal-service" uk-icon="file-edit" @click="updateService(service)" uk-tooltip="Editar servicio" uk-toggle></a>
                            </li>
                            <li>
                                <a role="button" uk-icon="trash" @click="deleteService(service)" uk-tooltip="Eliminar servicio"></a>
                            </li>
                            <li>
                                <a role="button" uk-icon="tag" uk-tooltip="Descuento"></a>

                                <div uk-dropdown="mode: click">
                                    
                                    <div v-if="!service.discount">
                                        <small>
                                            No hay promociones o descuetos asociados a este servicio
                                        </small>
                                        
                                        <hr class="uk-divider-small">

                                        <a href="#modal-discount" class="uk-link-reset uk-text-small" @click="createDiscount(service)" uk-toggle>
                                            <span class="uk-margin-small-left" uk-icon="plus-circle"></span> Agregar descuento
                                        </a>
                                    </div>
                                    
                                    <div v-else>
                                        <p class="uk-text-bold">
                                            {{ service.discount.name }}
                                        </p>

                                        <hr class="uk-divider-small">

                                        <ul class="uk-iconnav">
                                            <li>
                                                <a href="#modal-discount" uk-icon="file-edit" @click="editDiscount(service)" uk-toggle></a>
                                            </li>
                                            <li>
                                                <a role="button" uk-icon="trash" @click="deleteDiscount(service)"></a>
                                            </li>
                                        </ul>
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
            updateService: function (service) {
                EventBus.$emit('editService', service);
            },
            createDiscount: function (service) {
                EventBus.$emit('createDiscount', service);
            },  
            editDiscount: function (service) {
                EventBus.$emit('editDiscount', service);
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
            deleteDiscount: function (service) {
                UIkit.modal.confirm('¿Estás seguro que deseas elimiar este servicio? Ten en cuenta que puede haber pagos relacionados.').then(() => {

                    let url = route('app.finances.services.discount.delete', { id : service.public_id, ID : service.discount.public_id});

                    axios.delete(url)
                    .then( response => {

                        service.discount = null;                        
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

                this.services[index].discount = discount;

            });

        }
    }

</script>
