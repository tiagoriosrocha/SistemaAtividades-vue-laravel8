<template>
    <div class="card" :class="borda">
        <div class="card-header text-white" :class="fundo">
            {{ index+1 }} - {{ post.title }}
        </div>
        
        <div class="card-body">
            <p>{{ post.description }}</p>
        </div>

        <div class="card-footer">
            <a href="#" class="btn btn-sm" :class="botao"><font-awesome-icon icon="fa-solid fa-pen-to-square" /></a>
            <a href="#" class="btn btn-sm" :class="botao"><font-awesome-icon icon="fa-solid fa-trash" /></a>
            <a href="#" class="btn btn-sm" @click="$root.$emit('descerPost',index)" v-show="descer" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-down" /></a>
            <a href="#" class="btn btn-sm" @click="$root.$emit('subirPost',index)" v-show="subir" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-up" /></a>
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
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>