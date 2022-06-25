<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" :class="borda">
                    <div class="card-header" :class="borda">
                        <p :class="letra">
                            {{ title }}  
                            <!-- <span class="badge bg-black text-white rounded-pill">#{{ id }}</span> -->
                        </p>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12" v-for="(post, index) in listaPosts" :key="post.id" :post="post">
                                <post-component @exibir-post="exibirPost" @editar-post="editarPost" @deletar-post="deletarPost" @descer-post="descerPost" @subir-post="subirPost" :color="color" :index="index" :post="post" :descer="descer" :subir="subir"></post-component>
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
        
        data() {
            return {
                listaPosts: [],
                postShow : []
            }
        },
        
        filters: {
            filtroDataHora: function (date) {
                return moment(date).format('DD/MM/YYYY H:mm');
            }
        },
        
        mounted() {
            this.$root.$on('receberPost', this.addPost)
            this.$root.$on('updated-post', this.updatePost)
            
            console.log('FrameComponent: Frame ' + this.title +' montado')
        },
        
        created(){
            this.listaPosts = this.posts
            this.ordenarPosts()
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
            descerPost(index){
                //gambiarra pra funcionar no heroku, não sei pq os primary keys estão incrementando de 10 em 10
                this.$emit('movimentar-post', this.id, this.id+1, this.posts[index])
                this.posts.splice(index, 1)
            },

            subirPost(index){
                //gambiarra pra funcionar no heroku, não sei pq os primary keys estão incrementando de 10 em 10
                this.$emit('movimentar-post', this.id, this.id-1, this.posts[index])
                this.posts.splice(index,1)
            },

            addPost(post, destino){
                if( destino == this.id ){
                    this.posts.push(post)
                    this.ordenarPosts()
                }
            },

            deletarPost(index, post){                
                this.$emit('deletar-post',post)
                this.posts.splice(index,1)
            },

            exibirPost(index, post){
                this.$emit('exibir-post',post)
            },

            ordenarPosts(){
                this.listaPosts.sort(function (a, b) {
                if (a.id > b.id) {
                    return 1;
                }
                if (a.id < b.id) {
                    return -1;
                }
                
                return 0;
                });
            },

            updatePost(post){
                for(var i=0; i<this.listaPosts.length; i++){
                    var umPost = this.listaPosts[i]
                    if( umPost.id == post.id ){
                        this.listaPosts.splice(i,1)
                        this.listaPosts.push(post)
                        this.ordenarPosts()
                    }
                }
            },

            editarPost(index, post){
                
            }
        }
    }
</script>
