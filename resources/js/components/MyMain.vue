<template>
    <main>


        <div class="container">

            <div v-if="loadingInProgress == true" class="d-flex justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-else class="row d-flex justify-content-center">
                <h1 class="col-8">Posts</h1>
                <div class="card col-8 my-3" v-for="(post, index) in posts" :key="index" style="width: 18rem;">
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
                <nav class="col-8" style="padding-left:0;">
                    <ul class="pagination">
                        <li class="page-item" :class="(currentPage == 1)? 'disabled' : ''"><a class="page-link"  href="#" @click="getPosts(currentPage -1)">Previous</a></li>
                        <li class="page-item disabled"><span class="page-link">{{currentPage}}/{{lastPage}}</span></li>
                        <li class="page-item" :class="(currentPage == lastPage)? 'disabled' : ''"><a class="page-link"  href="#" @click="getPosts(currentPage + 1)">Next</a></li>
                    </ul>
                </nav>
            </div>

        </div>

    </main>
</template>

<script>
    export default {
        name: 'MyMain',
        data() {
            return {
                posts: [],
                loadingInProgress: true,
                currentPage: 1,
                lastPage: null,
            }
        },
        methods: {
            getPosts(page) {
                this.loadingInProgress = true; //to display the spinner on page change

                axios.get('/api/posts', {
                    params: {
                        page: page
                    }
                })
                .then((response) => {
                    this.posts = response.data.results.data;
                    this.loadingInProgress = false;
                    this.currentPage = response.data.results.current_page;
                    this.lastPage = response.data.results.last_page
                    console.log(response);
                })
            },
            cutText(text, textLength) {
               return text.substring(0, textLength) + '...';
            }
        },
        mounted() {
            this.getPosts(1);
        }
    };
</script>

<style></style>
