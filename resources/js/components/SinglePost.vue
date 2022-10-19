<template>

    <div class="card col-8 my-3" style="width: 18rem;">
        <img :src="post.cover_image" class="card-img-top w-100 p-1">
        <div class="card-body" >
            <h5 class="card-title">{{post.title}}</h5>
            <p class="card-text mb-5">{{(post.content.length < 40)? post.content : cutText(post.content, 40)}}</p>
            <div class="card-text my-3">{{(post.category)? 'Category: ' + post.category.name:'No Category'}}</div>
            <div class="card-text" v-if="post.tags.length > 0" >
                Tags: <span class="mx-2 badge badge-pill badge-success" v-for="(tag, index) in post.tags" :key="index">{{tag.name}} </span>
            </div>
            <div class="card-text" v-else>Tags: -</div>
            <router-link :to="{name: 'post-page', params: {slug: post.slug}}" class="btn btn-primary my-3">View Post</router-link>
        </div>
    </div>

</template>

<script>
export default {
    name: 'SinglePost',
    props: [
        'post',
    ],
    methods: {
        cutText(text, textLength) {
               return text.substring(0, textLength) + '...';
            }
    }
}
</script>

<style>

</style>
