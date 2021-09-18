
require('sweetalert');
"use strict";
window.VueAdmin=require('vue');
window.axios = require('axios');
// import Vuex from 'vuex';
// import FileManager from 'laravel-file-manager'
// VueAdmin.use(Vuex);
// create Vuex store,
// const store = new Vuex.Store();
// VueAdmin.use(FileManager, {store});
import 'vue-select/dist/vue-select.css';
import attributeAdd from '../components/AttributeAdd.vue';
import getImageGalleryProduct from "../components/getImageGalleryProduct";
import vSelect from 'vue-select'
VueAdmin.component('attribute-add', attributeAdd);
VueAdmin.component('v-select', vSelect)
VueAdmin.component('getImageGalleryProduct',getImageGalleryProduct);
const app = new VueAdmin({
    // store,
    el: '#app',
});
