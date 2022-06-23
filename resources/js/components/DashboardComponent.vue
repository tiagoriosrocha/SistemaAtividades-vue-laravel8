<template>
    <div>
        <div v-for="(frame, index) in frames" :key="index">
            <div v-if="index == 0">
                <frame-component @exibir-post="exibirPost" @deletar-post="deletarPost" @movimentar-post="movimentar" :descer="true" :subir="false" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
            <div v-else-if="index == 2">
                <frame-component  @exibir-post="exibirPost" @deletar-post="deletarPost" @movimentar-post="movimentar" :descer="false" :subir="true" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
            <div v-else>
                <frame-component  @exibir-post="exibirPost" @deletar-post="deletarPost" @movimentar-post="movimentar" :descer="true" :subir="true" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
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

        <create-post-component :frameid="this.frames[0].id" @novo-post="salvarPost" ></create-post-component>
        <details-post-component></details-post-component>
    </div>
</template>

<script>

import moment from 'moment';
import FrameComponent from './FrameComponent.vue';

export default {    
    components: { FrameComponent },
        
    props: {
        'frames' : [],
    },

    data() {
        return {
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
            console.log("show modal")
            //enviar o frame ID
        },

        salvarPost(post){
            this.movimentar(0, this.frames[0].id, post)
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

    }
}
</script>