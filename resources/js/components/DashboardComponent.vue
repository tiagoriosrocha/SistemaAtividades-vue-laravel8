<template>
    <div>
        <div v-for="(frame, index) in frames" :key="index">
            <div v-if="index == 0">
                <frame-component @movimentar-post="movimentar" :descer="true" :subir="false" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
            <div v-else-if="index == 2">
                <frame-component @movimentar-post="movimentar" :descer="false" :subir="true" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
            <div v-else>
                <frame-component @movimentar-post="movimentar" :descer="true" :subir="true" :color="frame.color" :title="frame.title" :id="frame.id" :posts="frame.posts"></frame-component>
                <br>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'frames' : [],
        },
        
        methods: {
            movimentar(origem, destino, post){
                console.log("dashboard: movimentar => origem: " + origem)
                console.log("dashboard: movimentar => destino: " + destino)
                console.log("dashboard: movimentar => objeto: " + JSON.stringify(post))
                this.$root.$emit('receberPost',post, destino)
            }
        }
    }
</script>