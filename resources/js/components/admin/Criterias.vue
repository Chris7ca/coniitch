<template>
    
    <div>

        <div class="uk-margin-medium-top" v-if="!dataLoaded">
            <h6 class="uk-text-muted">Cargando datos... <span uk-spinner="ratio: 0.8"></span></h6>
        </div>

        <ul uk-accordion v-else>
            <li v-for="(criteria, index) in criterias" :key="index">
                <a class="uk-accordion-title" role="button">{{ criteria.title }}</a>   

                <div class="uk-accordion-content">
                    <ul class="uk-subnav uk-subnav-divider" uk-margin>
                        <li><span class="uk-text-meta">{{ axis(criteria.axis) }}</span></li>
                        <li><a role="button" @click="editCriteria(criteria.public_id)" uk-icon="file-edit"></a></li>
                        <li><a role="button" @click="deleteCriteria(criteria.public_id)" uk-icon="trash"></a></li>
                    </ul>
                    
                    <p>{{ criteria.description }}</p>
                </div>
            
            </li>
        </ul>

        <h6 class="uk-text-muted uk-margin-medium-top" v-if="dataLoaded && criterias.length == 0">Aún no se han registrado criterios de evaluación...</h6>

    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';

    export default {

        data () {
            return {
                dataLoaded: false,
                axes: [
                    { name: 'Investigación', value: 'Research' },
                    { name: 'Teórico', value: 'Theoretical' },
                    { name: 'Ambos', value: 'BothOfThem' }
                ],
                criterias: []
            }
        },
        methods: {
            axis: function (axis) {
                return this.axes.filter( a => a.value == axis)[0].name;
            },
            editCriteria: function (id) {
                
                let url = route('app.criterias.edit', { id : id });
                EventBus.$emit('editCriteria', url);
            },
            deleteCriteria: function (id) {
                
                let url = route('app.criterias.delete', { id : id });

                UIkit.modal.confirm(`¿Estás seguro que deseas elimiar este criterio? 
                Ten en cuenta que si ya se ha evaluado un trabajo con él, se eliminará todo registro de dicha evaluación`).then( () => {

                    axios.delete(url)
                    .then( response => {

                        let index = this.criterias.findIndex( c => c.public_id == id);

                        this.criterias.splice(index, 1);
                        UIkit.notification(response.data.message, 'success');
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });

                }, () => {});

            }
        },
        created () {

            axios.post(route('app.criterias.index'))
            .then( response => {
                this.dataLoaded = true;
                this.criterias = response.data;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });

            EventBus.$on('wasCreatedNewCriteria', (criteria) => {
                this.criterias.push(criteria);
            });

            EventBus.$on('wasUpdatedCriteria', (criteria) => {

                let index = this.criterias.findIndex( c => c.public_id == criteria.public_id );
                
                this.criterias[index].title = criteria.title;
                this.criterias[index].axis = criteria.axis;
                this.criterias[index].description = criteria.description;
            });

        }

    }

</script>

