<template>
    
    <div class="uk-grid-medium uk-flex-around uk-flex-middle" uk-grid>
    
        <div class="uk-text-center">
            <h6>Agregar</h6>
            <a href="#modal-sponsor" class="uk-button-primary uk-box-shadow-hover-large" uk-icon="plus" style="padding: 10px; border-radius: 50%; color: #fafafa;" uk-toggle></a>
        </div>


        <div class="uk-text-center" v-if="loader">
            <div>
                <h6>Cargando... <span uk-spinner="ratio: 0.8"></span></h6>
            </div>
        </div>

        <div  v-for="(sponsor, index) in sponsors" :key="index" v-else>

            <div>

                <a role="button">
                    <img :data-src="sponsor.image.file.replace('public','/storage')" :width="sponsor.image.width" uk-img>
                </a>
    
                <div uk-dropdown="mode: click">

                    <h6>{{ sponsor.display_name }}</h6>
                    
                    <ul class="uk-iconnav uk-flex uk-flex-center uk-margin-medium-top">

                        <li>
                            <a href="#modal-sponsor" @click="editSponsor(sponsor)" uk-icon="file-edit" uk-toggle></a>
                        </li>

                        <li>
                            <a role="button" @click="deleteSponsor(sponsor)" uk-icon="trash"></a>
                        </li>

                    </ul>

                </div>

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
                sponsors: []
            }
        },
        methods: {
            image: function(image) {
                return image.replace('public', '/storage');
            },
            editSponsor: function(sponsor) {

                EventBus.$emit('editSponsor', sponsor);
            },
            deleteSponsor: function (sponsor) {
                
                UIkit.modal.confirm('¿Deseas eliminar a este patrocionador?').then( () => {

                    let url = route('app.publicrelations.sponsors.delete', { id : sponsor.public_id });

                    axios.delete(url)
                    .then( response => {
                        
                        let index = this.sponsors.findIndex( s => s.public_id = sponsor.public_id);

                        this.sponsors.splice(index, 1);
                        UIkit.notification(response.data.message, 'success');
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });
                }, () => {});
            }
        },
        created () {

            axios.post(route('app.publicrelations.sponsors.index'))
            .then( response => {
                this.sponsors = response.data;
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('wasCreatedNewSponsor', sponsor => {
                this.sponsors.push(sponsor);
            });

            EventBus.$on('wasUpdatedSponsor', sponsor => {

                let index = this.sponsors.findIndex( s => s.public_id == sponsor.public_id );

                this.sponsors[index].url = sponsor.url;
                this.sponsors[index].image.file = sponsor.image.file;
                this.sponsors[index].image.width = sponsor.image.width;
                this.sponsors[index].display_name = sponsor.display_name;
                this.sponsors[index].description = sponsor.description;
            });
        }

    }

</script>
