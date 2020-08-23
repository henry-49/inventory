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

// Import Notification Class
import Notification from "./Helpers/Notification";

// making Notification globally available
window.Notification = Notification;

// Sweet Alert start
import Swal from "sweetalert2";

// support it
window.Swal =  Swal;

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

window.Toast = Toast;
// Sweet Alert end

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'  // remove the # on the url
});



const app = new Vue({
    el: '#app',
    router
});
