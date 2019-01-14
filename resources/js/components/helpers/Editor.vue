<template>
    <div class="uk-textarea" :id="id" :value="value"></div>
</template>

<script>
    
    export default {
        props:['id','value'],
        data() {
            return {
                editor: null
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

            BalloonEditor.create( document.querySelector( `#${ckeditorId}` ),{
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
                this.editor.model.document.on( 'change:data' , () => {
                    if (this.editor.getData() !== this.value) {
                        this.$emit('input', this.editor.getData());
                    }
                } );
            } )
            .catch( err => {
                console.error( err.stack );
            } );

        }
    }

</script>