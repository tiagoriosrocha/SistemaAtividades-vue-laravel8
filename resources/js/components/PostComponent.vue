<template>
    <div class="card">
        <div class="card-header">
            {{ post }}
        </div>
        
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>{{ post.description }}</p>
                <footer class="blockquote-footer">{{ post.created_at }}</footer>
            </blockquote>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'post' : []
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>