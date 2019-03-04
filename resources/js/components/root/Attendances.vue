<template>
    
    <div>

        <div v-if="event == null">
            <h6 class="uk-text-center">Selecciona un evento para ver su asistencia</h6>
        </div>

        <div v-else>

            <h5>{{ event.name }}</h5>
            <p>{{ event.description }}</p>

            <nav class="uk-navbar-container uk-margin-medium-top" uk-navbar>
                <div class="uk-navbar-left">
                    <flat-pickr class="uk-input" v-model="date" required placeholder="Selecciona una fecha"></flat-pickr>
                </div>
                <div class="uk-navbar-right">
                    <h6 class="uk-text-right">Total de asistentes: {{ attendances.length }}</h6>
                </div>
            </nav>

            <table class="uk-table uk-table-divider uk-table-middle uk-table-justify uk-table-responsive">

                <thead>
                    <tr>
                        <th>Día</th>
                        <th class="uk-table-shrink"></th>
                        <th>Asistente</th>
                    </tr>
                </thead>
                
                <tbody>

                    <tr v-for="attendance in attendances" :key="attendance.public_id">
                        <td>
                            {{ attendance.date }}
                        </td>
                        <td>
                            <img :src="getAvatar(attendance.user.avatar)" class="avatar-small uk-preserve-width">
                        </td>
                        <td>
                            {{ attendance.user.first_name + ' ' + attendance.user.last_name }}
                        </td>
                    </tr>

                    <tr v-if="date == null">
                        <td colspan="3" class="uk-text-center">
                            Selecciona una fecha para ver su la asistencia ...
                        </td>
                    </tr>

                    <tr v-else-if="loader">
                        <td colspan="3" class="uk-text-center">
                            Cargando ... <span class="uk-margin-small-left" uk-spinner="ratio: 0.8"></span>
                        </td>
                    </tr>

                    <tr v-else-if="attendances.length == 0">
                        <td colspan="3" class="uk-text-center">
                            No hay asistencias en este día ...
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>

</template>

<script>
    
    import { EventBus } from './../../bus.js';
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';

    export default {
        components: {
            flatPickr
        },
        data () {
            return {
                loader: false,
                event: null,
                date: null,
                attendances: [],
            }
        },
        watch: {
            date: function (value) {

                let url = route('app.root.events.attendances', { id : this.event.public_id });

                this.loader = true;

                axios.post(url, { date : value })
                .then( response => {
                    this.loader = false;
                    this.attendances = response.data;
                })
                .catch( error => {
                    this.loader = false;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created () {

            EventBus.$on('viewAttendances', event => {
                this.event = event;
                this.attendances = [];
            });
        }
    }

</script>

<style>

</style>
