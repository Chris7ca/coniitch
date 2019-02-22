<template>

    <div>

        <content-placeholders v-if="!dataLoaded">
            <content-placeholders-heading/>
            <content-placeholders-text :lines="3"/>
        </content-placeholders>

        <div v-if="dataLoaded">

            <h4>Crear o editar roles</h4>
            <hr class="uk-divider-small">

            <form @submit.prevent="handleSubmit" class="uk-uk-form-stacked">
                <div class="uk-margin">
                    <label class="uk-form-label">Clave del rol</label>
                    <input type="text" class="uk-input" v-model="key" required placeholder="Requerido...">
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Nombre del rol</label>
                    <input type="text" class="uk-input" v-model="displayName" required placeholder="Requerido...">
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Descripción del rol</label>
                    <textarea class="uk-textarea" rows="5" v-model="description" required placeholder="Requerido..."></textarea>
                </div>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary rounded-button" type="submit">{{ textButtonSubmit }}</button>
                </div>
            </form>

        </div>

    </div>

</template>


<script>
    
    import { EventBus } from './../../bus.js';

    export default {

        data() {
            return {
                dataLoaded: true,
                mode: 'create',
                indexRole: '',
                publicId: '',
                key: '',
                displayName: '',
                description: ''
            }
        },
        computed: {
            textButtonSubmit: function() {
                return (this.mode == 'create') ? 'Crear rol' : 'Actualizar rol';
            }
        },
        methods: {
            getData: function() {
                return {
                    key: this.key,
                    display_name: this.displayName,
                    description: this.description
                }
            },
            handleSubmit: function() {

                let data = this.getData();
                this.dataLoaded = false;

                if (this.mode == 'create') {
                    this.storeRole(data);
                } else {
                    this.updateRole(data);
                }
            },
            storeRole: function(data) {
                axios.post(route('app.root.roles.store'), data)
                .then( role => {
                    this.dataLoaded = true;
                    EventBus.$emit('newRole', role.data);
                    UIkit.notification('Rol creado', 'success');
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            },
            updateRole: function(data) {
                axios.post(route('app.root.roles.update', { id : this.publicId }), data)
                .then( role => {
                    this.dataLoaded = true;
                    UIkit.notification('Rol actualizado', 'success');
                    EventBus.$emit('roleUpdated', this.indexRole, role.data);
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created() {

            EventBus.$on('editRole', (index, url) => {

                this.dataLoaded = false;
                this.indexRole = index;

                axios.post(url)
                .then( role => {
                    this.mode = 'update';
                    this.dataLoaded = true;
                    this.key = role.data.key;
                    this.publicId = role.data.public_id;
                    this.displayName = role.data.display_name;
                    this.description = role.data.description;
                })
                .catch( error => {
                    this.dataLoaded = true;
                    showAxiosErrorMessage(error);
                });
            }); 
        }
        
    }
    
</script>