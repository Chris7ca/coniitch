<template>
    
    <li class="item-light">

        <a role="button" uk-icon="icon: bell"> 
            <sup v-if="loaded && unreadNotifications > 0">
                <span class="uk-badge uk-background-muted uk-text-primary">{{ unreadNotifications }}</span>
            </sup>
        </a>
        
        <div class="uk-navbar-dropdown uk-padding-remove uk-overflow-hidden" style="width: 300px;">

            <ul class="uk-list uk-list-divider uk-margin-remove notifications-list">

                <li class="uk-padding-small" v-if="notifications.length == 0 && loaded">
                    <h6 class="uk-text-center uk-text-muted">No tienes notificaciones recientes...</h6>
                </li>
                
                <li :class="{'item-notification': true, 'item-notification-readed': notification.read_at != null}" v-for="(notification, index) in notifications" :key="index" v-else>
                    
                    <a role="button" class="uk-flex uk-flex-middle uk-padding-small uk-link-reset" @click="getRoute(notification.id, notification.data.route)" uk-grid>

                        <div class="uk-width-auto">
                            <div class="icon-notification"></div>
                        </div>

                        <div class="uk-width-expand uk-margin-left uk-padding-remove">
                            <h6 class="uk-margin-remove-bottom">{{ notification.data.title }}</h6>
                            <span class="uk-margin-remove uk-text-meta">
                                {{ dateOfCreation(index) }}
                            </span>
                        </div>

                    </a>

                </li>

            </ul>

            <div class="uk-width-1-1 uk-background-primary uk-light uk-text-center" style="padding: 5px 0px;" v-if="notifications.length > 0">
                <a :href="route('app.notifications.view')" class="uk-link-reset uk-text-small">Ver todas</a>
            </div>
            
        </div>

    </li>

    

</template>

<script>
    
    export default {

        data () {
            return {
                loaded: false,
                notifications: [],
                unreadNotifications: 0
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

            let url = route('app.notifications.widget');

            axios.post(url)
            .then( response => {
                this.loaded = true;
                
                if ( response.data.notifications ) {
                    this.notifications = response.data.notifications.map( notification => {
                        notification.data = JSON.parse(notification.data);
                        return notification;
                    });
                    this.unreadNotifications = response.data.unread_notifications;
                }
            })
            .catch( error => {
                showAxiosErrorMessage(error);
            });

        }

    }

</script>
