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
                            <div class="col-md-3" v-for="(post, index) in posts" :key="post.id" :post="post">
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
            'id' : [Number, String],
            'color' : String,
            'posts' : [],
        },
        filters: {
            filtroDataHora: function (date) {
                return moment(date).format('DD/MM/YYYY H:mm');
            }
        },
        mounted() {
            console.log('Component mounted.')
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
        }
    }
</script>
