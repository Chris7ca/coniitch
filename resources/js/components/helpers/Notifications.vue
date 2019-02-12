<template>
    
    <ul class="uk-list uk-list-divider">

        <li v-if="notifications.length == 0 && loaded">
            <h6 class="uk-text-center">No tienes notificaciones aún...</h6>
        </li>

        <li v-for="(notification, index) in notifications" :key="index">
            
            <div class="uk-flex uk-flex-middle uk-padding" uk-grid>

                <div class="uk-width-auto">
                    <span class="uk-text-primary" :uk-icon="`icon: ${ notification.data.icon }; ratio: 1.3;`"></span>
                </div>

                <div class="uk-width-expand">
                    <h6 class="uk-margin-small-bottom">
                        {{ notification.data.title }}
                        <span class="uk-label light-text" v-if="notification.read_at == null"><small>Nueva</small></span>
                    </h6>

                    <ul class="uk-subnav uk-subnav-divider uk-padding-remove-horizontal uk-text-meta">
                        <li>{{ dateOfCreation(index) }}</li>
                        <li><a @click="getRoute(notification.id, notification.data.route)">Ver</a></li>
                    </ul>

                    <p class="uk-margin-small">
                        <small>{{ notification.data.description }}</small>
                    </p>
                </div>

            </div>

        </li>

    </ul>

</template>

<script>
    
    export default {
        
        data () {
            return {
                loaded: false,
                notifications: []
            }
        },
        methods: {
            getRoute: function (id, url) {

                let uri = route('app.notifications.read', { uuid : id });

                axios.post(uri)
                .then( response => {
                    window.location = url;
                })
                .catch( error => {
                    showAxiosErrorMessage(error);
                });

            },
            dateOfCreation: function (index) {

                let createdAt  = this.notifications[index].created_at
                let createdAgo = this.notifications[index].created_ago;
                
                let now     = new Date();
                let today   = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                let array   = createdAt.substring(0, 10).split('-');
                let date    = new Date(array[0], (array[1] - 1), array[2]);
                
                let days    = (today - date) / 1000 / 60 / 60 / 24; 

                return ( days > 30 ) ? createdAt.substring(0, (createdAt.length - 3)) : createdAgo;
            }
        },
        created () {

            let url = route('app.notifications.index');

            axios.post(url)
            .then( response => {
                this.loaded = true;
                this.notifications = response.data.map( notification => {
                    notification.data = JSON.parse(notification.data);
                    return notification;
                });
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

        }

    }
    
</script>
