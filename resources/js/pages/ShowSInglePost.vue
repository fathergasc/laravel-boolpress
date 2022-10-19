<template>
    <div class="container py-3" v-if="singlePost">
        <h1 class="my-3">{{ singlePost.title }}</h1>
        <img class="w-100 mb-5" :src="singlePost.cover_image" alt="">
        <p>{{singlePost.content}}</p>
        <div class="mb-3">Category: {{(singlePost.category)? singlePost.category.name:'-'}}</div>
        <div v-if="singlePost.tags.length > 0">
            Tags:
            <span  v-for="(tag, index) in singlePost.tags" :key="index">
                <span class="mx-2 badge badge-pill badge-success">{{tag.name}}</span>
            </span>
        </div>
        <div v-else>Tags: -</div>

        <router-link class="btn btn-primary mt-3" :to="{name: 'posts'}">Back</router-link>
    </div>
</template>

<script>
export default {
    name: 'ShowSinglePost',
    data() {
        return {
            singlePost: null,
        }
    },
    methods: {
        getPostSlug() {
            const slug = this.$route.params.slug;

            axios.get('/api/posts/' + slug)
            .then((response) => {
                this.singlePost = response.data.results;
            })
        }
    },
    mounted() {
        this.getPostSlug();
    }
    }
</script>

<style>

</style>
