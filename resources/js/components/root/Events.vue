<template>

    <div>

        <a href="#modal-event" class="uk-button uk-padding-remove" uk-toggle>
            <span class="uk-margin-small-right" uk-icon="plus-circle"></span> Nueva
        </a>

        <ul class="uk-nav uk-nav-default uk-margin-medium-top">
            <li class="uk-margin-bottom" v-for="event in events" :key="event.public_id">
                <a role="button" class="uk-padding-remove">{{ event.name }}</a>
                <div uk-dropdown>

                    <h6>Opciones</h6>

                    <ul class="uk-iconnav uk-padding-remove">

                        <li>
                            <a href="#modal-event" @click="editEvent(event)" uk-icon="file-edit" uk-toggle></a>
                        </li>
                        
                        <li>
                            <a role="button" @click="deleteEvent(event)" uk-icon="trash"></a>
                        </li>

                        <li>
                            <a role="button" @click="viewAttendances(event)" uk-icon="eye"></a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>

    </div>

</template>

<script>

    import { EventBus } from './../../bus.js';
    
    export default {
        data () {
            return {
                loading: true,
                events: []
            }
        },
        methods: {
            viewAttendances: function (event) {
                EventBus.$emit('viewAttendances', event);
            },
            editEvent: function (event) {
                EventBus.$emit('editEvent', event);
            },
            deleteEvent: function (event) {
                UIkit.modal.confirm('¿Estás seguro que deseas elimiar esta actividad? Ten en cuenta que puede haber asistencias relacionados.').then(() => {

                    let url = route('app.root.events.delete', { id : event.public_id });

                    axios.delete(url)
                    .then( response => {

                        let index = this.events.findIndex( e => e.public_id == event.public_id );
                        
                        this.events.splice(index, 1);
                        UIkit.notification(response.data.message, 'success');

                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });

                }, () => {});
            }
        },
        created () {

            let url = route('app.root.events.index');

            axios.post(url)
            .then( response => {
                this.events = response.data;
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

            EventBus.$on('eventCreated', event => {
                this.events.push(event);
            });
        }
    }

</script>

<style>

</style>
