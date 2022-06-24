<template>
    <div id="exibirAtividade" class="modal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">#{{ postShow.id }} - {{ postShow.title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <span v-for="situation in situations" :key="situation.id">
                    <input type="checkbox" :checked="temSituacao(situation)" class="btn-check" :id="'btn-check-' + situation.id" >
                    <label class="btn btn-sm btn-outline-primary" @click="alterarSituation(situation)" :for="'btn-check-' + situation.id">
                        <!-- <font-awesome-icon :icon="temSituacao(situation) ? 'fa-solid fa-minus' : 'fa-solid fa-plus' " />  -->
                        {{ situation.title }}
                    </label>
                </span>
                <hr>
                <div class="mb-1">
                    <div v-if="!editarTitle">
                        <label class="form-label">
                            Title: {{ postShow.title }}
                            <a class="btn btn-sm btn-outline-primary" @click="criarFormTitle"><font-awesome-icon icon="fa-solid fa-pen-to-square" /></a>
                        </label>
                    </div>
                    <div v-else>
                        Title: 
                        <input class="form" v-on:keyup.enter="salvarTitle" type="text" v-model="titleText" > 
                        <a class="btn btn-sm btn-outline-primary" @click="salvarTitle"><font-awesome-icon icon="fa-solid fa-floppy-disk" /></a>
                    </div>
                </div>
                <div class="mb-1">
                    <div v-if="!editarDescription">
                        <label for="description" class="form-label">
                            Description: {{ postShow.description }}
                            <a class="btn btn-sm btn-outline-primary" @click="criarFormDescription"><font-awesome-icon icon="fa-solid fa-pen-to-square" /></a>
                        </label>
                    </div>
                    <div v-else>
                        Description: 
                        <input class="form" v-on:keyup.enter="salvarDescription"  type="text"  v-model="descriptionText"> 
                        <a class="btn btn-sm btn-outline-primary" @click="salvarDescription"><font-awesome-icon icon="fa-solid fa-floppy-disk" /></a>
                    </div>
                </div>
                <div class="mb-1">
                    <div v-if="!editarScheduledto">
                        <label for="scheduledto" class="form-label">
                            Scheduled to: {{ postShow.scheduledto | filtroDataHora}}
                            <a class="btn btn-sm btn-outline-primary" @click="criarFormScheduledto"><font-awesome-icon icon="fa-solid fa-pen-to-square" /></a>
                        </label>
                    </div>
                    <div v-else>
                        Scheduleto to: 
                        <input class="form"  v-on:keyup.enter="salvarScheduleto"  type="text"  v-model="scheduledtoText"> 
                        <a class="btn btn-sm btn-outline-primary" @click="salvarScheduleto"><font-awesome-icon icon="fa-solid fa-floppy-disk" /></a>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="scheduledto" class="form-label">Created at: {{ postShow.created_at | filtroDataHora}}</label>
                </div>
                <div class="mb-1">
                    <label for="scheduledto" class="form-label">Updated at: {{ postShow.updated_at | filtroDataHora}}</label>
                </div>
                
                <div v-if="qtdMsg > 0">
                    <hr>
                    <div style="height: 200px; overflow-y: scroll;">
                        <div class="col-sm-12 col-md-12" v-for="(msg, index) in postShow.messages" :key="index">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Title: {{ msg.title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Date: {{ msg.created_at | filtroDataHora }}</h6>
                                    <p class="card-text">Text: {{ msg.text }}</p>
                                    <a class="btn btn-outlined btn-sm btn-outline-danger" @click="deletarMensagem(index)">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <create-message-component v-if="exibirFormMensagem" @created-message="mensagemCriada" :postId="postShow.id"></create-message-component>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="criarMensagem">New Message</button>
                <button type="button" class="btn btn-secondary" @click="fecharModal" data-bs-dismiss="modal">Close</button>
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
            qtdMsg: 0,
            editarTitle : false,
            editarDescription : false,
            editarScheduledto : false,
            titleText : "",
            descriptionText : "",
            scheduledtoText : "",
            exibirFormMensagem : false,
            situations : []
        }
    },

    mounted() {
        this.$root.$on('exibir-post', this.addPost)
        console.log('ShowPostComponent: showPostComponent ' + this.postShow.id + ' montado')
    },

    filters: {
        filtroDataHora: function (date) {
            return moment(date).format('DD/MM/YYYY H:mm');
        }
    },

    methods: {
        addPost(post){
            this.postShow = post

            axios.get('/post/' + post.id)
            .then(response => {
                this.postShow = response.data
                console.log('ShowPostComponent (addPost): buscando post ok')
            })
            .catch(error => (console.log("ShowPostComponent (addPost): resposta erro: " + error)));

            this.qtdMsg = post.messages.length

            axios.get('/situations')
            .then(response => {
                this.situations = response.data
                console.log('ShowPostComponent (addPost): busca situations ok')
            })
            .catch(error => (console.log("ShowPostComponent (addPost): resposta erro: " + error)));
        },

        criarFormTitle(){
            this.titleText = this.postShow.title
            this.editarTitle = true
        },

        criarFormDescription(){
            this.descriptionText = this.postShow.description
            this.editarDescription=true
        },

        criarFormScheduledto(){
            this.scheduledtoText = this.postShow.scheduledto
            this.editarScheduledto=true
        },

        fecharModal(){
            this.editarTitle = false
            this.editarDescription = false
            this.editarScheduledto = false
            this.exibirFormMensagem = false
        },

        salvarTitle(){
            this.editarTitle = false
            this.postShow.title = this.titleText
            this.persistirUpdate('title',this.postShow.title)
        },

        salvarDescription(){
            this.editarDescription = false
            this.postShow.description = this.descriptionText
            this.persistirUpdate('description',this.postShow.description)
        },

        salvarScheduleto(){
            this.editarScheduledto = false
            this.postShow.scheduledto = this.scheduledtoText
            this.persistirUpdate('scheduledto',this.postShow.scheduledto)
        },

        persistirUpdate(campo, valor){
            axios.post('/post/editar', {
                'id': this.postShow.id,
                'campo': campo,
                'valor': valor,
            })
            .then(response => {
                console.log(response)
                var post = response.data
                this.$root.$emit('updated-post', post)
                console.log("ShowPostComponent (persistirUpdate): alterar campo post ok")
            })
            .catch(error => (console.log("ShowPostComponent (persistirUpdate): resposta erro: " + error)));
        },

        criarMensagem(){
            this.exibirFormMensagem = true
        },

        mensagemCriada(message){
            this.exibirFormMensagem = false
            this.qtdMsg++
            this.postShow.messages.push(message)
        },

        deletarMensagem(index){
            var id = this.postShow.messages[index].id
            axios.post('/message/delete', {
                'id': id,
            })
            .then(response => {
                this.postShow.messages.splice(index,1)
                this.qtdMsg--
                console.log("ShowPostComponent (deletarMensagem): deletar mensagem ok")
            })
            .catch(error => (console.log("ShowPostComponent (deletarMensagem): resposta erro: " + error)));
        },

        temSituacao(situation){
            var result = false
            for(var i=0; i<this.postShow.situations.length; i++){
                var umaSituacao = this.postShow.situations[i]
                if(umaSituacao.id == situation.id)
                    result = true
            }
            return result
        },

        alterarSituation(situation){
            axios.post('/post/situation/edit', {
                'post_id': this.postShow.id,
                'situation_id': situation.id,
                'habilitar': !this.temSituacao(situation)
            })
            .then(response => {
                var post = response.data
                this.$root.$emit('updated-post', post)
                console.log("ShowPostComponent (alterarSituation): alterar situation ok")
            })
            .catch(error => (console.log("ShowPostComponent (alterarSituation): resposta erro: " + error)));

        }
    }
}
</script>