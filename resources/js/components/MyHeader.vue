<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Boolpress</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active" v-for="(link, index) in navBarLinks" :key="index">
                        <router-link class="nav-link" :to="{ name: link.route }">{{link.text}}</router-link>
                    </li>
                    <li class="nav-item active"><a class="nav-link" href="/admin">Back-Office</a></li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'MyHeader',
    data() {
        return {
            navBarLinks: [
                {
                    text: 'Home',
                    route: 'home'
                },
                {
                    text: 'Posts',
                    route: 'posts'
                },
                {
                    text: 'Contact Us',
                    route: 'contact-us'
                },
                {
                    text: 'About Us',
                    route: 'about-us'
                },
            ]
        };
    },
};
</script>

<style></style>
