<template>
    
    <ul class="uk-pagination uk-margin-remove" v-if="total > perPage">
        <li v-if="pages >= 2"><a role="button" @click="getPage(firstPage)" uk-icon="icon: chevron-double-left"></a></li>
        <li v-for="(page, i) in pages" :key="i">
            <a role="button" :class="{ 'uk-text-bold uk-text-primary' : (currentPage  == page) }" @click="getPage(page)">{{ page }}</a>
        </li>
        <li v-if="pages >= 2"><a role="button" @click="getPage(lastPage)" uk-icon="icon: chevron-double-right"></a></li>
    </ul>

</template>

<script>
    
    export default {
        props: ['url'],
        data () {
            return {
                total: 0,
                pages: 0,
                perPage: 0,
                firstPage: 1,
                lastPage: 0,
                currentPage: 1
            }
        },
        watch: {
            url: function (url) {

                this.getItems(url);
            }
        },
        methods: {
            getPage: function(page) {

                this.$emit('updateItems', []);
                this.$emit('updateLoader', true);

                axios.post(this.url.template, { page: page })
                .then( response => {

                    this.currentPage = response.data.current_page;
                    this.items       = response.data.data;

                    this.$emit('updateLoader', false);
                    this.$emit('updateItems', response.data.data);
                })
                .catch( error => {
                    this.$emit('updateLoader', false);
                    showAxiosErrorMessage(error);
                });
            },
            getItems: function (url) {

                axios.post(url)
                .then( response => {

                    this.total      = response.data.total;
                    this.perPage    = response.data.per_page;
                    this.pages      = (Math.ceil(this.total / this.perPage) <= 1) ? 0 : Math.ceil(this.total / this.perPage);
                    this.lastPage   = this.pages;
                    
                    this.$emit('updateLoader', false);
                    this.$emit('updateItems', response.data.data);
                })
                .catch( error => {
                    this.loader =  false;
                    showAxiosErrorMessage(error);
                });
            }
        },
        created () {

            this.getItems(this.url);
        }
    }

</script>
