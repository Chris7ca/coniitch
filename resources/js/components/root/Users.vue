<template>

    <div> 

        <nav class="uk-navbar-container uk-navbar-transparent uk-margin" uk-navbar>

            <div class="nav-overlay uk-navbar-left">
                <pagination :url="route('app.root.users.index')" @updateItems="updateItems" @updateLoader="updateLoader"></pagination>
            </div>

            <div class="nav-overlay uk-navbar-right">
                <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
            </div>

            <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>
                <div class="uk-navbar-item uk-width-expand">
                    <div class="uk-search uk-search-navbar uk-width-1-1">
                        <input class="uk-search-input" type="search" v-model="querySearch" placeholder="Buscar usuario..." autofocus>
                    </div>
                </div>
                <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
            </div>

        </nav>

        <table class="uk-table uk-table-middle uk-table-divider uk-table-responsive table-cards">

            <thead>
                <tr>
                    <th class="uk-table-shrink"></th>
                    <th class="uk-width-small">Nombre</th>
                    <th class="uk-width-small">Correo</th>
                    <th>Roles</th>
                    <th class="uk-table-shrink">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <tr v-if="!dataLoaded">
                    <td colspan="5">
                        <content-placeholders :rounded="true">
                            <content-placeholders-heading :img="true" />
                        </content-placeholders>
                    </td>
                </tr>

                <tr v-for="(user, index) in users" :key="index" v-else>
                    <td class="uk-text-center">
                        <img :src="getAvatar(user.avatar)" class="avatar-small uk-preserve-width">
                    </td>
                    <td>
                        <a href="#modal-profile" class="uk-button button-text uk-padding-remove" @click="showProfile(user.public_id)" uk-toggle>{{ fullName(user) }}</a>
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                    <td>
                        <small v-for="(role, i) in user.roles" class="uk-text-primary" :key="i"> {{ role.display_name }}.</small>
                    </td>
                    <td>
                        <ul class="uk-iconnav uk-flex-center">
                            <li v-if="user.has_personal_profile">
                                <a ></a>
                            </li>
                            <li v-if="user.email_verified_at == null">
                                <span class="uk-text-warning" uk-icon="warning" uk-tooltip="Usuario no verificado"></span>
                            </li>
                            <li>
                                <a role="button" @click="editUser(user.public_id)" uk-icon="file-edit"></a>
                            </li>
                            <li>
                                <a role="link" @click="deleteUser(user.public_id)" uk-icon="trash"></a>
                            </li>
                            <li>
                                <a href="#modal-documents" @click="documents(user.public_id)" uk-icon="folder" uk-toggle></a>
                            </li>
                        </ul>
                    </td>
                </tr>

            </tbody>

            <tfoot>
                <tr v-if="dataLoaded && users.length == 0">
                    <td class="uk-text-center" colspan="5" style="border: none;">
                        <h5>No hemos encontrado usuarios ...</h5>
                    </td>
                </tr>
            </tfoot>

        </table>
        
    </div>
</template>

<script>
    
    import { EventBus } from './../../bus.js';
    import Pagination from './../helpers/Pagination.vue';

    export default {
        components:{
            Pagination
        },
        data() {
            return {
                dataLoaded: false,
                users: [],
                tempUsers: [],
                searchTableActive: false,
                querySearch: ''
            }
        },
        watch: {
            querySearch: function(val) {

                if (val != '' && val.length > 2) {

                    this.dataLoaded = false;
                    
                    axios.post(route('app.root.users.search', { search : val }))
                    .then( users => {
                        this.users              = users.data;
                        this.searchTableActive  = true;
                        this.dataLoaded         = true;
                    })
                    .catch( error => {
                        this.dataLoaded        = true;
                        this.searchTableActive = false;
                        showAxiosErrorMessage(error);
                    });

                } else if ( val.length < 2 ) {
                    console.log('ok')
                    this.users              = this.tempUsers;
                    this.searchTableActive  = false;
                }
            }
        },
        methods: {
            fullName: function (user) {

                let secondName = (user.personal_profile) ? user.personal_profile.second_name : '';
                let secondLastName = (user.personal_profile) ? user.personal_profile.second_last_name : '';

                return user.first_name + ' ' + secondName + ' ' + user.last_name + ' ' + secondLastName;
            },
            updateItems: function (users) {
                this.users      = users;
                this.tempUsers  = users;
            },
            updateLoader: function (status) {
                this.dataLoaded = !status;
            },
            showProfile: function (id) {
                EventBus.$emit('showProfile', id);
            },
            editUser: function (id) {

                let url = route('app.root.users.edit', { id : id });

                EventBus.$emit('editUser', url);
            },
            deleteUser: function (id) {

                let self = this;
                let url  = route('app.root.users.delete', { id : id });

                UIkit.modal.confirm('¿Estás seguro que deseas eliminar este usuario?').then(function () {
                    axios.delete(url)
                    .then( response => {

                        let index = self.users.findIndex( u => u.public_id == id );

                        self.users.splice(index, 1);
                        UIkit.notification(response.data.message, 'success');
                    })
                    .catch( error => {
                        showAxiosErrorMessage(error);
                    });
                }, () => {});
            },
            documents: function (id) {
                EventBus.$emit('documentsUser', id);
            }
        },
        created() {

            EventBus.$on('userUpdated', (user) => {

                let index = this.users.findIndex( u => u.public_id == user.public_id);

                this.users[index].first_name = user.first_name;
                this.users[index].last_name = user.last_name;
                this.users[index].email = user.email;
                this.users[index].roles = user.roles;
            });

        }
    }

</script>