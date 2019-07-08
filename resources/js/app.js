import Vue from "vue";
import VueRouter from 'vue-router'
import routes from "./routes/index";
import Vuex from 'vuex'
import Swal from 'sweetalert2';
import store from './store/index';
import axios from 'axios';
import JQuery from  'jquery';
import VueProgressBar from 'vue-progressbar';
import CKEditor from '@ckeditor/ckeditor5-vue';
import PacmanLoader from "vue-spinner/src/PacmanLoader.vue";
import InfiniteLoading from 'vue-infinite-loading';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

Vue.use(CKEditor);
window.Vue = require('vue');
window.axios = axios;
window.Swal = Swal;
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(InfiniteLoading);
window.JQuery=JQuery;


const options = {
    color: "#006400",
    failedColor: '#FF0000',
    thickness: '6px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};

Vue.use(VueProgressBar, options);


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: true,
    timer: 3000
});
const SwalDeleteAlert = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false,
});


window.SwalDeleteAlert = SwalDeleteAlert;
window.Toast = Toast;


const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        'pacman-loader': PacmanLoader,
    }

});
