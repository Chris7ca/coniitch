<template>
    
    <div id="modal-assign-revisors" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <h5>Selecciona los revisores para este trabajo</h5>

            <ul class="uk-list">
                <li v-for="(revisor, index) in revisors" :key="index">
                    <label class="text-light">
                        <input type="checkbox" :value="revisor.public_id" v-model="revisorsSelected" class="uk-checkbox"> {{ revisor.first_name + ' ' + revisor.last_name }}
                    </label>
                </li>
            </ul>
            
            <div class="uk-margin-medium">
                <button class="uk-button uk-button-default uk-modal-close" :disabled="loading">Cancelar</button>
                <button class="uk-button uk-button-primary uk-box-shadow-hover-large" @click="assign" :disabled="loading">Asignar revisores</button>
            </div>
            
        </div>
    </div>
    
</template>

<script>

    import { EventBus } from './../../bus.js';

    export default {
        
        data () {
            return {
                loading: false,
                revisors: [],
                id: '',
                revisorsSelected: []
            }
        },
        watch: {
            revisorsSelected: function (val) {
                if (val.length > 2) {
                    UIkit.notification('No se puden asigar más de dos revisores', 'warning');
                    this.revisorsSelected = [];
                }
            }
        },
        methods: {
            assign: function () {
                
                let url = route('app.admin.works.assign.revisors', { id : this.id });
                let data = { revisors : this.revisorsSelected };
                this.loading = true;

                axios.post(url, data)
                .then( response => {

                    this.loading = false;
                    let revisors = this.revisors.filter( r => r.public_id == this.revisorsSelected[0] || r.public_id == this.revisorsSelected[1] ); 

                    UIkit.modal('#modal-assign-revisors').hide();
                    UIkit.notification(response.data.message, 'success');
                    EventBus.$emit('assignedRevisors', this.id, revisors);
                })
                .catch( error => {

                    this.loading = false;

                    showAxiosErrorMessage(error);
                });

            }
        },
        created () {

            let url = route('app.admin.works.revisors');

            axios.post(url)
            .then( response => {
                this.revisors = response.data;
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('assignRevisors', (id) => {
                this.id = id;
                this.revisorsSelected = [];
            });

        }

    }

</script>
