<template>
    <div class="card" :class="borda">
        <div class="card-header text-white" :class="fundo">
           <div class="row">
           <div class="col-8 text-start">
                {{ index+1 }} - {{ post.title.substring(0,25) }}
            </div>
            <div class="col-4 text-end">
                <span class="badge bg-light text-black rounded-pill">#{{ post.id }}</span>
            </div>
           </div>
        </div>
        
        <div class="card-body collapse">
            <p>{{ post.description }}</p>
        </div>

        <div class="card-footer">
            <div class="row">
            <div class="col-6">
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
            <div class="col-6 text-end">
                <div v-if="isRunning">
                    <a href="#" class="btn btn-sm btn-outline-danger rounded-pill">
                        <font-awesome-icon icon="fa-solid fa-pause" />
                    </a>
                    {{ time }}
                </div>
                <div v-else>
                    <a href="#" class="btn btn-sm btn-outline-success rounded-pill">
                        <font-awesome-icon icon="fa-solid fa-play" />
                    </a>
                    {{ time }}
                </div>
            </div>
            </div>
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

        data() {
            return {
                time : "00:00:00",
                isRunning : false,
            }
        },

        mounted(){
            console.log('PostComponent: PostComponent ' + this.post.id + ' montado')
            this.time = this.post.time
            this.isRunning = this.post.isrunning
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