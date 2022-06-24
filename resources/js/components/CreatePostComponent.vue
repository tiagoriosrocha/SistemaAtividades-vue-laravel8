<template>
    <div id="novaAtividadeModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" id="title" v-model="title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <input type="text" class="form-control" id="description" v-model="description">
                        </div>
                        <div class="mb-3">
                            <label for="scheduledto" class="form-label">Scheduled to:</label>
                            <input type="text" class="form-control" id="scheduledto" v-model="scheduledto">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="criarPost">Save</button>
                </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    
    props: {
        'frameid' : Number,
    },

    data() {
        return {
            title: "Título",
            description: "Descrição",
            scheduledto: "2022-07-30 13:00:00",
        }
    },

    mounted(){
        console.log('CreatePostComponent: CreatePostComponent montado')
    },

    methods: {
        criarPost(){
            axios.post('/post', {
                'title': this.title,
                'description': this.description,
                'scheduledto': this.scheduledto,
                'frameid' : this.frameid
            })
            .then(response => {
                var post = response.data
                this.$emit('novo-post', post)
                console.log("CreatePostComponent (criarPost): axios - salvar post ok")
            })
            .catch(error => (console.log("CreatePostComponent (criarPost): axios - resposta erro: " + error)));
            
        },
    }
}
</script>