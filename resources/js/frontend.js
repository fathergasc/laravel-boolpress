
//import axios
window.axios = require("axios");
//adds Header everytime an axios request is made: makes it so all axios calls are answered with a json
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//alternative method to import Vue
//window.Vue = require("vue");

import Vue from 'vue';

import App from "./views/App";

import router from './router.js';

const app = new Vue({
    el: "#root",
    render: (h) => h(App),
    router
});
