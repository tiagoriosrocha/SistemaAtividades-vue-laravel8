<template>
    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-2">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" v-model="title">
            </div>
            <div class="mb-2">
                <label for="text" class="form-label">Text:</label>
                <textarea row="3" class="form-control" id="text" v-model="text"></textarea>
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-primary" @click="salvarMensagem">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
    props: {
        'postId' : Number,
    },
    
    data() {
        return {
            title : "",
            text : "",
        }
    },

    mounted(){
        console.log('CreateMessageComponent: CreateMessageComponent montado')
    },

    methods: {
        salvarMensagem(){
            axios.post('/message', {
                'title': this.title,
                'text': this.text,
                'post_id' : this.postId,
            })
            .then(response => {
                var message = response.data
                this.title = ""
                this.text = ""
                this.$emit('created-message', message)
                console.log("CreateMessageComponent (salvarMensagem): axios - salvar mensagem ok")
            })
            .catch(error => (console.log("CreateMessageComponent (salvarMensagem): axios - resposta erro: " + error)));
        }
    }
}
</script>