<template>
    <div>
        <div class="row row-cols-1 row-cols-md-4 g-4" v-if="post">
            <div class="card">
            <img :src="'/storage/' + post.image" class="card-img-top" :alt="post.name">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <h4 class="card-title">{{ post.author }}</h4>
                <p class="card-text">{{ post.content }}</p>
            </div>
            </div>
        </div>
        </div>
</template>

<script>
import Axios from "axios";

export default {
name: 'Post',
props: ['id'],
    data() {
        return {
            post: null
        }
        },
        created() {
        const url = 'http://127.0.0.1:8000/api/v1/posts/' + this.id;
        this.getPost(url);
        },
        methods: {
        getPost(url){
            Axios.get(url).then(
                (result) => {
                console.log(result);
                this.post = result.data.results.data;
                });
        }
        }
}
</script>

<style>

</style>