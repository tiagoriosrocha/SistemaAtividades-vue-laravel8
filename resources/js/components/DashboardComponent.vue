<template>
    <div>
        <div v-for="(frame, index) in frames" :key="index">
            <div v-if="index == 0">
                <frame-component @exibir-post="exibirPost" @editar-post="editarPost" @deletar-post="deletarPost" @movimentar-post="movimentar" :descer="true" :subir="false" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
            <div v-else-if="index == 2">
                <frame-component  @exibir-post="exibirPost" @editar-post="editarPost" @deletar-post="deletarPost" @movimentar-post="movimentar" :descer="false" :subir="true" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
            <div v-else>
                <frame-component  @exibir-post="exibirPost" @editar-post="editarPost" @deletar-post="deletarPost" @movimentar-post="movimentar" :descer="true" :subir="true" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
        </div>

        <div class="position-fixed bottom-0 end-50">
            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Create new Post">
                <a href="#" class="btn btn-lg btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#novaAtividadeModal" @click="novaAtividade">
                    <font-awesome-icon icon="fa-solid fa-plus" />
                </a>
            </span>
        </div>

        <div v-show="modal" id="novaAtividadeModal" class="modal" tabindex="-1">
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="salvarAtividade">Save</button>
                </div>
                </div>
            </div>
        </div>

        <post-details-component></post-details-component>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        props: {
            'frames' : [],
        },

        data() {
            return {
                modal: true,
                title: "Título",
                description: "Descrição",
                scheduledto: "2022-07-30 13:00:00",
                post: [],
                destino: Number,
                postShow: []
            }
        },

        filters: {
            filtroDataHora: function (date) {
                return moment(date).format('DD/MM/YYYY H:mm');
            }
        },
        
        methods: {
            movimentar(origem, destino, post){
                console.log("dashboard: movimentar => origem: " + origem)
                console.log("dashboard: movimentar => destino: " + destino)
                console.log("dashboard: movimentar => objeto: " + JSON.stringify(post))
                this.$root.$emit('receberPost',post, destino)

                axios.post('/post/movimentar', {
                    'id': post.id,
                    'frame_id': destino,
                })
                .then(response => (console.log("Post movimentado ok")))
                .catch(error => (console.log("resposta erro: " + error)));
            },

            novaAtividade(){
                this.modal = true
                //this.title = ""
                //this.description = ""
                //this.scheduledto = ""
                console.log("show modal")
            },

            salvarAtividade(){
                console.log("criando nova atividade")
                
                axios.post('/post', {
                    'title': this.title,
                    'description': this.description,
                    'scheduledto': this.scheduledto,
                    'frameid' : this.frames[0].id
                })
                .then(response => (this.movimentar(0,this.frames[0].id,response.data)))
                .catch(error => (console.log("resposta erro: " + error)));

                //this.title = ""
                //this.description = ""
                //this.scheduledto = ""
            },

            deletarPost(post){                
                axios.post('/post/delete',{
                    'id': post.id
                })
                .then(response => (console.log('post deletado')))
                .catch(error => (console.log("resposta erro: " + error)));
            },

            exibirPost(post){
                axios.get('/post/' + post.id)
                .then(response => {
                    this.postShow = response.data
                    this.$root.$emit('exibir-post',this.postShow)
                 })
                .catch(error => (console.log("resposta erro: " + error)));
            },

            editarPost(post){

            }
        }
    }
</script>