<template>

    <nav class="uk-container uk-navbar-container uk-navbar-transparent" uk-navbar="mode: click">
        
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li class="uk-hidden@m">
                    <a href="" uk-icon="icon: menu"></a>
                </li>
                <li>
                    <a href="#">Menu</a>
                </li>
            </ul>
        </div>

        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <!-- notificaciones -->
                <li>
                    <a :href="route('app.index')"> 
                        <img :src="avatar"  class="uk-margin-small-right avatar-navbar"> 
                        {{ user.first_name + ' ' + user.last_name }}
                        <span uk-icon="triangle-down"></span>
                    </a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li class="uk-nav-header">
                                <small>Opciones</small>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="uk-margin-small-right" uk-icon="icon: user"></span> Editar Perfil
                                </a>
                            </li>
                            <li>
                                <a role="button" @click="logout">
                                    <span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

    </nav>
    
</template>

<script>
    
    export default {
        
        props: ['user'],
        data() {
            return {

            }
        },
        computed: {
            avatar: function() {
                
                let avatar;
                
                if (this.user.avatar != null && this.user.method_to_register != 'Traditional') {
                    avatar = this.avatar;
                } else if (this.user.avatar != null && this.user.method_to_register == 'Traditional') {
                    avatar = this.avatar.replace('public','/storage');
                } else {
                    avatar = '/images/avatar.png';
                }

                return avatar;
            }
        },
        methods: {
            logout: function() {
                axios.post(route('logout'))
                .then( response => {
                    window.location = route('site.login');
                })
                .catch( error => {
                    console.log(error);
                });
            }
        }
        
    }

</script>
