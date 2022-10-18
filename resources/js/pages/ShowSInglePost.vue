<template>
    <div class="container">
        <h1>single post page</h1>
    </div>
</template>

<script>
export default {
    name: 'ShowSinglePost',
    methods: {
        getPostSlug() {
            const slug = this.$route.params.slug;

            axios.get('/api/posts/' + slug)
            .then((response) => {
                console.log(response)
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
