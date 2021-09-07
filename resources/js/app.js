
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import 'bootstrap/dist/css/bootstrap.css'
import axios from 'axios'

Vue.component('order-detail', require('./components/OrderDetail.vue').default);

const app = new Vue({
    el: '#app',
});
