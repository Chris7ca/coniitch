<template>
    
    <div>

        <table class="uk-table uk-table-divider uk-table-middle uk-table-resposive">

            <thead>
                <tr>
                    <th class="uk-width-small">Clave</th>
                    <th>Nombre</th>
                    <th class="uk-table-expand">Descripción</th>
                    <th class="uk-table-shrink uk-text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <tr v-if="!dataLoaded">
                    <td colspan="4">
                        <content-placeholders :rounded="true">
                            <content-placeholders-heading />
                        </content-placeholders>
                    </td>
                </tr>

                <tr v-for="(role, index) in roles" :key="index">
                    <td>{{ role.key }}</td>
                    <td>{{ role.display_name }}</td>
                    <td>{{ role.description }}</td>
                    <td>
                        <ul class="uk-iconnav uk-flex uk-flex-center">
                            <li><a role="button" uk-icon="file-edit" @click="editRole(index)"></a></li>
                            <li><a role="button" @click="deleteRole(index)" uk-icon="trash"></a></li>
                        </ul>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</template>

<script>
    
    import { EventBus } from './../../bus.js';

    export default {
        data() {
            return {
                dataLoaded: false,
                roles: []
            }
        },
        methods: {
            editRole: function (index) {

                let url = route('app.root.roles.edit', { id : this.roles[index].public_id });
                EventBus.$emit('editRole', index, url);
            },
            deleteRole: function (index) {
                
                let self = this;
                let url = route('app.root.roles.delete', { id : this.roles[index].public_id });
                
                UIkit.modal.confirm('¿Estás seguro que deseas eliminar este rol?').then(function () {
                    axios.delete(url)
                    .then( response => {
                        self.roles.splice(index, 1);
                        UIkit.notification(response.data.message, 'success');
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });
                }, null);
            }
        },
        created() {

            axios.post(route('app.root.roles.index'))
            .then( roles => {
                this.dataLoaded = true;
                this.roles = roles.data;
            }) 
            .catch( error => {
                this.dataLoaded = true;
                showAxiosErrorMessage(error);
            });

            EventBus.$on('newRole', role => {
                this.roles.push(role);
            });

            EventBus.$on('roleUpdated', (index, role) => {
                this.roles[index].key = role.key;
                this.roles[index].display_name = role.display_name;
                this.roles[index].description = role.description;
            });

        }
    }
    
</script>