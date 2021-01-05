// require('./bootstrap');
window.Vue1 = require('vue');
window.axios = require('axios');
// import Vue from 'vue';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue1.component('attribute-add', require('./components/AttributeAdd.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

Vue1.component('v-select', vSelect)
const app = new Vue1({
    el: '#app',
});
