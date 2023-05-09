//bootstrap

require('./bootstrap');
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

import {routes} from './routes/route-front';

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
import storeData from './store/store2'
const store = new Vuex.Store(
	storeData
);

//pagination

Vue.component('pagination', require('laravel-vue-pagination'));

//AutoComplete
import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'
 
Vue.use(Autocomplete)

//moment js
import {moment} from './filter/filter';


Vue.component('cart', require('./components/frontEnd/cart/cart.vue').default);
Vue.component('search', require('./components/frontEnd/search/search.vue').default);
Vue.component('search-form', require('./components/frontEnd/search/search-form.vue').default);
Vue.component('login', require('./components/frontEnd/login/customer-login.vue').default);
Vue.component('category', require('./components/frontEnd/category/category.vue').default);


const app = new Vue({
    el: '#contentFront',
    router,store
});
