<template>
    
    <div class="uk-flex uk-flex-column uk-flex-middle uk-text-center">

        <div class="avatar-container" style="height: 200px; width: 200px;">
            <img :src="avatar" v-if="imageLoaded">
            <img src="/svg/spinner.svg" v-else>
        </div>

        <h5>{{ user.first_name + ' ' + user.last_name }}</h5>
        
        <hr class="uk-divider-small uk-margin-remove-top uk-margin-bottom">

        <label class="uk-button uk-button-primary uk-box-shadow-hover-large text-white" for="avatar-input">Cambiar imagen de perfil</label>
        <input id="avatar-input" ref="avatar" type="file" @change="changeAvatar" accept="image/png, image/jpeg, image/jpg" hidden :disabled="uploadingAvatar">

        <span v-if="errorFile" class="uk-text-danger uk-text-small uk-margin">{{ textErrorFile }}</span>

        <div class="uk-margin" v-if="awaitingUploadImage">

            <ul class="uk-iconnav" v-if="!uploadingAvatar">
                <li>
                    <a role="button" @click="cancelChangeAvatar" uk-icon="icon: close" uk-tooltip="Cancelar"></a>
                </li>
                <li>
                    <a role="button" @click="uploadAvatar" uk-icon="icon: check" uk-tooltip="Cambiar imagen de perfil"></a>
                </li>
            </ul>

            <div uk-spinner v-else></div>
        </div>

    </div>

</template>


<script>

    export default {
        
        props: ['user'],
        data() {
            return {
                avatar: '/images/avatar.png',
                orgAvatar: '/images/avatar.png',
                imageLoaded: false,
                uploadingAvatar: false,
                awaitingUploadImage: false,
                errorFile: false,
                textErrorFile: ''
            }
        },
        watch: {
            file (file) {
                this.setImage(file);
            }
        },
        methods: {
            changeAvatar: function (event) {

                let file = event.target.files[0];
                let ext = this.getExtension(file.name);
                let size = file.size;
                let maxSize = 4194304; // bytes
                this.errorFile = '';

                if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' && size <= maxSize){

                    let reader = new FileReader();
                    this.imageLoaded = false;

                    reader.onload = (e) => {
                        this.avatar = e.target.result;
                        this.imageLoaded = true;
                        this.awaitingUploadImage = true;
                    }

                    reader.readAsDataURL(file);

                } else{

                    event.target.files[0].value = null;
                    this.errorFile = true;
                    this.textErrorFile = (size > maxSize) ? 'La imagen excede los 4 MB' : 'Formato de imagen no admitido. Por favor, sube archivos JPG, JPEG O PNG';
                }
            },
            getExtension: function (path) {
                
                let basename = path.split(/[\\/]/).pop();
                let pos = basename.lastIndexOf('.');

                if (basename === '' || pos < 1) {
                    return '';
                }
                return basename.slice(pos + 1);
            },
            uploadAvatar: function () {
                
                let data = new FormData();
                data.append('avatar', document.getElementById('avatar-input').files[0]);
                this.uploadingAvatar = true;

                axios.post(route('app.users.avatar.update'), data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response =>{
                    this.uploadingAvatar = false;
                    this.awaitingUploadImage = false;
                    this.orgAvatar = this.avatar;
                    UIkit.notification(response.data.message, 'success');
                })
                .catch( error => {
                    this.uploadingAvatar = false;
                    this.awaitingUploadImage = false;
                    showAxiosErrorMessage(error);
                });
            },
            cancelChangeAvatar: function () {
                this.avatar = this.orgAvatar;
                this.awaitingUploadImage = false;
            }
        },
        created () {

            this.avatar = this.getAvatar(this.user.avatar);
            this.orgAvatar = this.getAvatar(this.user.avatar);

        },
        mounted () {
            this.imageLoaded = true;
        }

    }

</script>
