<template>

    <div class="card col-8 my-3" style="width: 18rem;">
        <img :src="post.cover_image" class="card-img-top w-100 p-1">
        <div class="card-body" >
            <h5 class="card-title">{{post.title}}</h5>
            <p class="card-text">{{(post.content.length < 40)? post.content : cutText(post.content, 40)}}</p>
            <p class="card-text">{{(post.category)? post.category.name:'No Category'}}</p>
            <div class="card-text" v-if="post.tags.length > 0" >
                Tags: <span v-for="(tag, index) in post.tags" :key="index">{{tag.name}}; </span>
            </div>
            <p class="card-text" v-else>No Tags</p>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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
