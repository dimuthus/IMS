require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.min.css';
import 'mdbvue/lib/css/mdb.min.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import Vue from 'vue';
import VueRouter from 'vue-router';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faCoffee } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { BModal } from 'bootstrap-vue';

Vue.component('b-modal', BModal);
library.add(faCoffee);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.use(VueRouter);

//sweetalert2
import Swal from "sweetalert2";
window.Swal = Swal;
const Toast = Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000,
});
//laravel vue pagination
Vue.component('pagination', require('laravel-vue-pagination'));
window.Toast = Toast;
//notification
import Notification from "./Helpers/Notification";
window.Notification = Notification;
// globally onreload
window.Reload = new Vue();
//import user helpers
import User from "./Helpers/User";
window.User = User;
import {routes} from './routes';
const router = new VueRouter({
    routes,
});
const app = new Vue({
    el: '#app',
    router,
});
