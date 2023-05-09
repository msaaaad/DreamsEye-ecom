//bootstrap

require('./bootstrap');
// require('@fortawesome/fontawesome-free');


//Vue js
window.Vue = require('vue').default;

//V Form

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//Vue router

import VueRouter from 'vue-router';
Vue.use(VueRouter);

//Routes

import {routes} from './routes/routes';

const router = new VueRouter({
	routes,
	// mode:'history',

});

//SweerAlert2

import Swal from 'sweetalert2'

window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
window.Toast = Toast;

//Toastr js

import toastr from 'toastr';
window.toastr = toastr;

// Vuex

import Vuex from 'vuex'
Vue.use(Vuex)
import storeCategory from './store/store'
const store = new Vuex.Store(
	storeCategory
);

//moment js
import {moment} from './filter/filter';



// Vue.component('dashboard', require('./components/backend/dashboard.vue').default);

//pagination

Vue.component('pagination', require('laravel-vue-pagination'));


//AutoComplete
import Autocomplete from '@trevoreyre/autocomplete-vue'
// import '@trevoreyre/autocomplete-vue/dist/style.css'
 
Vue.use(Autocomplete)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#content',
    router,store
});
