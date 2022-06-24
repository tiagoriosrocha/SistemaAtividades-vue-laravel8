<template>
    <div class="card" :class="borda">
        <div class="card-header text-white" :class="fundo">
                {{ index+1 }} - {{ post.title.substring(0,25) }}  <span class="badge bg-light text-black rounded-pill">#{{ post.id }}</span>
        </div>
        
        <div class="card-body collapse">
            <p>{{ post.description }}</p>
        </div>

        <div class="card-footer">
            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="View Post">
                <a class="btn btn-sm" @click="exibirPost(index)" data-bs-toggle="modal" data-bs-target="#exibirAtividade" :class="botao"><font-awesome-icon icon="fa-solid fa-magnifying-glass" /></a>
            </span>
            <!-- <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Post">
                <a class="btn btn-sm" @click="editarPost(index)" :class="botao"><font-awesome-icon icon="fa-solid fa-pen-to-square" /></a>
            </span> -->
            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Post">
                <a class="btn btn-sm" @click="deletarPost(index)" :class="botao"><font-awesome-icon icon="fa-solid fa-trash" /></a>
            </span>
            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Down Post">
                <a class="btn btn-sm" @click="descerPost(index)" v-show="descer" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-down" /></a>
            </span>
            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Up Post">
                <a class="btn btn-sm" @click="subirPost(index)" v-show="subir" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-up" /></a>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'post' : [],
            'index' : Number,
            'descer' : Boolean,
            'subir' : Boolean,
            'color' : String,
        },

        mounted(){
            console.log('PostComponent: PostComponent ' + this.post.id + ' montado')
        },
        
        methods: {
            subirPost(index){
                //console.log("PostComponent (subirPost): Subir")
                this.$emit('subir-post',index)
            },
            descerPost(index){
                //console.log("PostComponent (descerPost): Descer")
                this.$emit('descer-post',index)
            },
            deletarPost(index){
                //console.log("PostComponent (deletarPost): Deletar")
                this.$emit('deletar-post',index, this.post)
            },
            exibirPost(index){
                //console.log("PostComponent (exibirPost): Exibir")
                this.$emit('exibir-post',index, this.post)
            },
            editarPost(index){
                //console.log("PostComponent (editarPost): Editar")
                this.$emit('editar-post',index, this.post)
            }
        },
        
        computed: {
            borda(){
                return "border-" + this.color
            },

            fundo(){
                return "bg-" + this.color
            },

            letra(){
                return "text-" + this.color
            },

            botao(){
                return "btn-outline-" + this.color
            }
        },
    }
</script>