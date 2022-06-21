<template>
    <div class="card" :class="borda">
        <div class="card-header text-white" :class="fundo">
                {{ index+1 }} - {{ post.title }}  <span class="badge bg-light text-black rounded-pill">#{{ post.id }}</span>
        </div>
        
        <div class="card-body">
            <p>{{ post.description }}</p>
        </div>

        <div class="card-footer">
            <a href="#" class="btn btn-sm" :class="botao"><font-awesome-icon icon="fa-solid fa-pen-to-square" /></a>
            <a href="#" class="btn btn-sm" :class="botao"><font-awesome-icon icon="fa-solid fa-trash" /></a>
            <a href="#" class="btn btn-sm" @click="descerPost(index)" v-show="descer" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-down" /></a>
            <a href="#" class="btn btn-sm" @click="subirPost(index)" v-show="subir" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-up" /></a>
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
        
        methods: {
            subirPost(index){
                console.log("PostComponent: Subir")
                this.$emit('subir-post',index)
            },
            descerPost(index){
                console.log("PostComponent: Descer")
                this.$emit('descer-post',index)
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