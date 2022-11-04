<template>
        <div class="container">

            <div v-if="loadingInProgress == true" class="d-flex justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-else class="row d-flex justify-content-center">
                <h1 class="col-8">Posts</h1>
                <div class="col-8">
                    <select name="categories" id="categories" v-model="selectedCategory" @change="getPosts(currentPage)">
                        <option value="">Choose category</option>
                        <option v-for="(category, index) in categories" :key="index" :value="category.id">{{category.name}}</option>
                    </select>
                </div>
                <div class="col-8" v-if="posts.length > 0">
                    <SinglePost v-for="(post, index) in posts" :key="index" :post="post" />
                </div>
                <div class="col-8 m-5" v-else>
                    <h3  >No posts</h3>
                    <p>Please, select another category.</p>
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
</template>

<script>
import SinglePost from '../components/SinglePost.vue';

    export default {
        components: {
            SinglePost,
        },
        name: 'PostsPage',
        data() {
            return {
                posts: [],
                categories: [],
                selectedCategory: null,
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
                        page: this.currentPage,
                        category: this.selectedCategory
                    }
                })
                .then((response) => {
                    this.posts = response.data.results.data;
                    this.loadingInProgress = false;
                    this.currentPage = response.data.results.current_page;
                    this.lastPage = response.data.results.last_page
                    //console.log(response);
                })
            },
            getCategories() {
                axios.get('/api/categories')
                .then((response) => {
                    this.categories = response.data.results;
                    console.log(response);
                })
            }
        },
        mounted() {
            this.getCategories();
            this.getPosts(1);

        }
    };
</script>

<style></style>

