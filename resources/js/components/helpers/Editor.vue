<template>
    <div>
        <div class="uk-textarea" :id="id" :value="value"></div>
        <span :class="{ 'uk-text-meta uk-align-right': true, 'uk-text-danger' : error.words }" v-if="countWords">
            {{ words }} palabras de {{ limitWords }}
        </span>
    </div>
</template>

<script>
    
    export default {
        props:['id','value','countWords','limitWords'],
        data() {
            return {
                editor: null,
                words: 0,
                error: {
                    words: false
                }
            }
        },
        watch: {
            value: function () {
                this.countWordsInText();
            }
        },
        methods: {
            countWordsInText: function () {

                let plainText   = document.getElementById(this.id).innerText;
                let arrayWords  = plainText.trim().replace(/\s+/gi, ' ').split(' ');

                this.words       = (arrayWords[0] == "" && arrayWords.length == 1) ? 0 : arrayWords.length;
                this.error.words = (this.words > this.limitWords);
                this.$emit('limit-words', (this.words - this.limitWords));
            }
        },
        beforeUpdate () {
            const ckeditorId = this.id;

            if (this.value !== this.editor.getData()) {
                this.editor.setData(this.value);
            }

        },
        mounted () {

            const ckeditorId = this.id

            BalloonEditor.create( document.querySelector( `#${ckeditorId}` ), {
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Párrafo', class: 'ck-heading_paragraph' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' },
                    ]
                }
            } )
            .then( editor => {

                this.editor = editor;
                this.editor.setData( this.value );
                this.countWordsInText();
                this.editor.model.document.on( 'change:data' , () => {

                    // if (this.editor.getData() !== this.value) {
                        this.$emit('input', this.editor.getData());
                    // }
                } );
            } )
            .catch( err => {
                console.error( err.stack );
            } );

        }
    }

</script>