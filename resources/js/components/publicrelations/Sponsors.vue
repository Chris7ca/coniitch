<template>
    
    <div class="uk-grid uk-grid-match uk-child-width-1-4@xl uk-child-width-1-3@m uk-child-width-1-2" uk-grid>

        <div>
            <div class="uk-placeholder uk-flex uk-flex-middle uk-flex-center" style="min-height: 400px;">
                
                <div class="uk-text-center">
                    <h6>Agregar</h6>
                    <a href="#modal-sponsor" class="uk-button-primary uk-box-shadow-hover-large" uk-icon="plus" style="padding: 10px; border-radius: 50%; color: #fafafa;" uk-toggle></a>
                </div>

            </div>
        </div>

        <div v-for="(sponsor, index) in sponsors" :key="index">
            <div class="uk-card uk-card-body card-default uk-box-shadow-small uk-flex uk-flex-column uk-flex-around uk-flex-middle" style="min-height: 400px;">
                
                <div style="width: 90%; height: auto;">
                    <img :src="image(sponsor.image)" alt="">
                </div>

                <div class="uk-text-center uk-margin">

                    <h6>{{ sponsor.display_name }}</h6>
                    
                    <ul class="uk-iconnav uk-flex uk-flex-center uk-margin-medium-top">

                        <li>
                            <a href="#modal-sponsor" @click="editSponsor(sponsor.public_id)" uk-icon="file-edit" uk-toggle></a>
                        </li>

                        <li>
                            <a role="button" @click="deleteSponsor(sponsor.public_id)" uk-icon="trash"></a>
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
                sponsors: []
            }
        },
        methods: {
            image: function(image) {
                return image.replace('public', '/storage');
            },
            editSponsor: function(id) {

                let url = route('app.sponsors.edit', { id : id });

                EventBus.$emit('editSponsor', url);
            },
            deleteSponsor: function (id) {
                
                UIkit.modal.confirm('¿Deseas eliminar a este patrocionador?').then( () => {

                    let url = route('app.sponsors.delete', { id : id });

                    axios.delete(url)
                    .then( response => {
                        
                        let index = this.sponsors.findIndex( s => s.public_id = id);

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

            axios.post(route('app.sponsors.index'))
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

                this.sponsors[index].display_name = sponsor.display_name;
                this.sponsors[index].image = sponsor.image.replace('public', '/storage');
            });
        }

    }

</script>
