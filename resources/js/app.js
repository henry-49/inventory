/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

// Import Routes
import { routes } from './routes';


// Import User Class
import User from './Helpers/User';

// making User globally available
window.User = User

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'  // remove the # on the url
});



const app = new Vue({
    el: '#app',
    router
});
