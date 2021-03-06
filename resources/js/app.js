/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'select2/dist/css/select2.min.css';

window.Vue = require('vue');
window.$ = require('jquery');
window.select2 = require('select2');

import VueMask from 'v-mask';
import money from 'v-money'
Vue.use(VueMask);
Vue.use(money, {precision: 4});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('card', require('./components/Card.vue').default);
Vue.component('select2', require('./components/Select2.vue').default);
Vue.component('venda', require('./components/Venda.vue').default);
Vue.component('dashboard', require('./views/Dashboard.vue').default);
Vue.component('listagem', require('./views/ListagemVendas.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
