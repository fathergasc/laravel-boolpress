import Vue from 'vue';

//imports vue-router
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import ContactUsPage from './pages/ContactUsPage.vue';
import PostsPage from './pages/PostsPage.vue';
import AboutUsPage from './pages/AboutUsPage.vue';
import HomePage from './pages/HomePage.vue';

const router = new VueRouter({
    mode: "history", //removes # from the routes generated by vue-router
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage,
        },
        {
            path: '/posts',
            name: 'posts',
            component: PostsPage,
        },
        {
            path: '/contact-us',
            name: 'contact-us',
            component: ContactUsPage,
        },
        {
            path: '/about-us',
            name: 'about-us',
            component: AboutUsPage,
        }
    ]
})

export default router;
