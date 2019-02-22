<template>

    <div>

        <h4>Estadísticas</h4>
        <hr class="uk-divider-small">

        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-expand" uk-leader>Usuarios</div>
            <div uk-spinner v-if="!dataLoaded"></div>
            <div v-else>{{ total }}</div>
        </div>

        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-expand" uk-leader>Total de registros</div>
            <div uk-spinner v-if="!dataLoaded"></div>
            <div v-else>{{ records }}</div>
        </div>

        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-expand" uk-leader>Registros validados</div>
            <div uk-spinner v-if="!dataLoaded"></div>
            <div v-else>{{ validateRecords }}</div>
        </div>
        
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-expand" uk-leader>Registros tradicionales</div>
            <div uk-spinner v-if="!dataLoaded"></div>
            <div v-else>{{ traditionalRecords }}</div>
        </div>

        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-expand" uk-leader>Registros por Google</div>
            <div uk-spinner v-if="!dataLoaded"></div>
            <div v-else>{{ googleRecords }}</div>
        </div>

        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-expand" uk-leader>Registros por Facebook</div>
            <div uk-spinner v-if="!dataLoaded"></div>
            <div v-else>{{ facebookRecords }}</div>
        </div>

    </div>
    
</template>


<script>

    export default {
        
        data() {
            return {
                dataLoaded: false,
                total: 0,
                records: 0,
                validateRecords: 0,
                traditionalRecords: 0,
                googleRecords: 0,
                facebookRecords: 0
            }
        },
        created () {

            axios.post(route('app.root.users.statistics'))
            .then( response => {
                this.dataLoaded = true;
                this.total = response.data.total;
                this.records = response.data.records;
                this.validateRecords = response.data.validate_records;
                this.traditionalRecords = response.data.traditional_records;
                this.googleRecords = response.data.google_records;
                this.facebookRecords = response.data.facebook_records;
            })
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error );
            });
        } 

    }
    
</script>
