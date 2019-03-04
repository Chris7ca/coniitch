<template>
    
    <div class="uk-grid uk-child-width-1-2@m" uk-grid>

        <div>
            <div>

                <qrcode-stream :camera="{ facingMode }" @init="onInit" @decode="onDecode">
                    <button class="uk-icon-button flip-camera" @click="switchCamera" uk-icon="refresh" uk-tooltip="Alternar cámara"></button>
                </qrcode-stream>

                <p>Nombre: <b>{{ qrDecoded }}</b></p>

                <p class="uk-text-danger uk-text-small" v-if="noFrontCamera">Tú dispositivo no posee una cámara frontal</p>
                <p class="uk-text-danger uk-text-small">{{ error }}</p>

                <ul class="uk-tab-right uk-margin-medium-top" uk-tab="connect: #attendances-tabs; animation: uk-animation-slide-top-medium">
                    <li v-for="event in events" :key="event.public_id">
                        <a role="button" @click="setEvent(event)">
                            <h6>{{ event.name }}</h6>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div>
            <div>

                <h4>Lista de asistencias del día</h4>
                <hr class="uk-divider-small"> 

                <ul id="attendances-tabs" class="uk-switcher uk-margin-medium-top">

                    <li v-for="event in events" :key="event.public_id">

                        <div v-if="event.attendances.length == 0">
                            <h5 class="uk-text-muted">No hay asistencias el día de hoy para: {{ event.name }} </h5>
                        </div>

                        <div class="uk-grid-small" uk-grid v-for="attendance in event.attendances" :key="attendance.public_id" v-else>
                            <div class="uk-width-expand" uk-leader>
                                {{ attendance.user.first_name + ' ' + attendance.user.last_name }}
                            </div>
                            <div>
                                {{ attendance.date.split(' ')[1] }}
                            </div>
                        </div>

                    </li>

                </ul>

            </div>
        </div>

    </div>

</template>

<script>
    
    import { QrcodeStream } from 'vue-qrcode-reader';

    const REAR_CAMERA  = { ideal: 'environment' };
    const FRONT_CAMERA = { exact: 'user' };

    export default {
        components: {
            QrcodeStream
        },
        data () {
            return {
                facingMode: REAR_CAMERA,
                noFrontCamera: false,
                qrResult: '',
                qrDecoded: '',
                error: '',
                currentEventID: '',
                events: []
            }
        },
        watch: {
            qrResult: function (value) {
                
                if ( this.events.length > 0 ) {

                    let val = JSON.parse(value);
                    let url =  route('app.staff.attendances.assign', { id : this.currentEventID, uuid : val.uuid });

                    this.qrDecoded = val.first_name + ' ' + val.last_name;

                    axios.post(url)
                    .then( response => {

                        let index = this.events.findIndex( e => e.public_id == this.currentEventID );
                        
                        this.events[index].attendances.push(response.data);

                        UIkit.notification('Asistencia asignada', 'success');
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });

                } else {
                    UIkit.notification('No hay eventos a los cuales registrar asistencias', 'warning');
                }
            }
        },
        methods: {
            onDecode (result) {
                this.qrResult = result;
            },
            switchCamera () {
                if ( this.facingMode === FRONT_CAMERA ) {

                    this.facingMode = REAR_CAMERA;
                    
                } else {

                    this.facingMode = FRONT_CAMERA;
                }
            },
            async onInit (promise) {
                try {
                    await promise
                } catch ( error ) {

                    this.noFrontCamera = this.facingMode === FRONT_CAMERA
                    && error.name === 'OverconstrainedError';

                    if (error.name === 'NotAllowedError') {
                        this.error = "ERROR: necesitas conceder permisos para utilizar la cámara";
                    } else if (error.name === 'NotFoundError') {
                        this.error = "ERROR: no camera on this device";
                    } else if (error.name === 'NotSupportedError') {
                        this.error = "ERROR: se require un contexto seguro (HTTPS, localhost)";
                    } else if (error.name === 'NotReadableError') {
                        this.error = "ERROR: ¿la cámara actualmente está en uso?";
                    } else if (error.name === 'OverconstrainedError') {
                        this.error = "ERROR: installed cameras are not suitable";
                    } else if (error.name === 'StreamApiNotSupportedError') {
                        this.error = "ERROR: este navegador no soporta la API de Stream";
                    }

                    console.error(error);
                }
            },
            setEvent: function (event) {
                this.currentEventID = event.public_id;  
            }
        },
        created () {
            
            let url = route('app.staff.attendances.index');

            axios.post(url)
            .then( response => {

                this.events = response.data;

                if ( response.data.length > 0 ) {
                    this.currentEventID = this.events[0].public_id;
                }

            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

        }
    }

</script>

<style>
    .flip-camera {
        position: absolute;
        left: 10px;
        top: 10px;
    }
</style>
