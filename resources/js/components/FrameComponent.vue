<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" :class="borda">
                    <div class="card-header" :class="borda">
                        <p :class="letra">{{ title }}</p>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3" v-for="(post, index) in listaPosts" :key="post.id" :post="post">
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
                                        <a href="#" class="btn btn-sm" @click="descerPost(index)" v-show="descer" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-down" /></a>
                                        <a href="#" class="btn btn-sm" @click="subirPost(index)" v-show="subir" :class="botao"><font-awesome-icon icon="fa-solid fa-arrow-up" /></a>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    

    export default {
        props: {
            'title' : String,
            'descer' : Boolean,
            'subir' : Boolean,
            'id' : [Number, String],
            'color' : String,
            'posts' : [],
        },
        watch: {
            
        },
        data() {
            return {
                listaPosts: []
            }
        },
        filters: {
            filtroDataHora: function (date) {
                return moment(date).format('DD/MM/YYYY H:mm');
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.$root.$on('receberPost', this.addPost)
        },
        created(){
            this.listaPosts = this.posts
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
        methods: {
            greet: function (event) {
                // `this` inside methods point to the Vue instance
                alert('Hello ' + this.name + '!')
                // `event` is the native DOM event
                alert(event.target.tagName)
            },
            descerPost(index){
                this.$emit('movimentar-post', this.id, this.id+1, this.posts[index])
                this.posts.splice(index, 1)
            },
            subirPost(index){
                this.$emit('movimentar-post', this.id, this.id-1, this.posts[index])
                this.posts.splice(index,1)
            },

            addPost(post, destino){
                if( destino == this.id ){
                    this.posts.push(post)
                    console.log("adicionado no vetor")
                }
            }
        }
    }
</script>
