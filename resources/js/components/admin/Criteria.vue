<template>
    
    <div>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-text :lines="3"/>
        </content-placeholders>

        <form @submit.prevent="handleSubmit" class="uk-form-stacked" v-else>

            <div class="uk-margin">
                <label class="uk-form-label">Título del criterio</label>
                <input type="text" v-model="title" class="uk-input" placeholder="Campo requerido" required>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">Eje</label>
                <multiselect v-model="selectedAxis" :searchable="false" label="name" track-by="value" :options="axes" required placeholder="Selecciona un eje"></multiselect>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">Descripción</label>
                <textarea class="uk-textarea" v-model="description" rows="5" placeholder="Campo requerido" required></textarea>
            </div>

            <div class="uk-margin-medium">
                <button class="uk-button uk-button-primary uk-box-shadow-hover-large">{{ textBtnSubmit }}</button>
            </div>

        </form>

    </div>

</template>


<script>

    import { EventBus } from './../../bus.js';
    import Multiselect from 'vue-multiselect';

    export default {
        
        components: {
            Multiselect
        },
        data () {
            return {
                mode: 'create',
                dataLoaded: true,
                id: '',
                title: '',
                axes: [
                    { name: 'Investigación', value: 'Research' },
                    { name: 'Teórico', value: 'Theoretical' },
                    { name: 'Ambos', value: 'BothOfThem' }
                ],
                selectedAxis: '',
                 description: '',
            }
        },
        computed: {
            textBtnSubmit: function () {
                return (this.mode == 'create') ? 'Crear criterio' : 'Actualizar datos';
            }
        },
        methods: {
            handleSubmit: function () {
                (this.mode == 'create') ? this.storeCriteria() : this.updateCriteria();
            },
            getData: function () {
                return {
                    title: this.title,
                    axis: this.selectedAxis.value,
                    description: this.description
                }
            },
            clearData: function () {
                this.title = '';  
                this.selectedAxis = '';  
                this.description = '';  
            },
            storeCriteria: function () {
                
                let data = this.getData();
                let url = route('app.admin.criterias.store');
                this.dataLoaded = false;

                axios.post(url, data)
                .then( response => {
                    this.dataLoaded = true;
                    this.clearData();
                    UIkit.notification('Criterio creado', 'success');
                    EventBus.$emit('wasCreatedNewCriteria', response.data);
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            },
            updateCriteria: function () {

                let data = this.getData();
                let url = route('app.admin.criterias.update', { id : this.id });
                this.dataLoaded = false;

                axios.post(url, data)
                .then( response => {
                    this.dataLoaded = true;
                    this.mode = 'create';
                    this.clearData();
                    UIkit.notification('Criterio actualizado', 'success');
                    EventBus.$emit('wasUpdatedCriteria', response.data);
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created () {

            EventBus.$on('editCriteria', url => {
                
                this.dataLoaded = false;

                axios.post(url)
                .then( response => {
                    this.mode = 'update';
                    this.dataLoaded = true;
                    this.id = response.data.public_id;
                    this.title = response.data.title;
                    this.selectedAxis = this.axes.filter( a => a.value == response.data.axis)[0];
                    this.description = response.data.description;
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            });
        }

    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>