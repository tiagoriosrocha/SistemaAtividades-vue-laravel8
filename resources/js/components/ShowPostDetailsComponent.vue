<template>
    <div id="exibirAtividade" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show Post Details #{{ postShow.id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label class="form-label">Title: {{ postShow.title }}</label>
                </div>
                <div class="mb-1">
                    <label for="description" class="form-label">Description: {{ postShow.description }}</label>
                </div>
                <div class="mb-1">
                    <label for="scheduledto" class="form-label">Scheduled to: {{ postShow.scheduledto | filtroDataHora}}</label>
                </div>
                <div class="mb-1">
                    <label for="scheduledto" class="form-label">Criado em: {{ postShow.created_at | filtroDataHora}}</label>
                </div>
                <div class="mb-1">
                    <label for="scheduledto" class="form-label">Atualizado em: {{ postShow.updated_at | filtroDataHora}}</label>
                </div>
                <div v-if="qtdMsg > 0">
                    <hr>
                    <div style="height: 200px; overflow-y: scroll;">
                        <div class="col-sm-12 col-md-12" v-for="(msg, index) in postShow.messages" :key="index">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Title: {{ msg.title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Data: {{ msg.created_at | filtroDataHora }}</h6>
                                    <p class="card-text">Mensagem: {{ msg.text }}</p>
                                    <a href="#" class="card-link">Deletar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>

import moment from 'moment';

export default {
    
    data() {
        return {
            postShow : [],
            qtdMsg: 0
        }
    },

    mounted() {
        this.$root.$on('exibir-post', this.addPost)
    },

    filters: {
        filtroDataHora: function (date) {
            return moment(date).format('DD/MM/YYYY H:mm');
        }
    },

    methods: {
        addPost(post){
            this.postShow = post
            this.qtdMsg = post.messages.length
            console.log("imprimindo detalhes do post: " + JSON.stringify(this.postShow))
        }
    }
}
</script>