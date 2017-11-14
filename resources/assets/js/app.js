
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

window.kebabCase = string => string.replace(/([a-z])([A-Z])/g, '$1-$2').replace(/\s+/g, '-').toLowerCase()

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('tailwind-fiddle', require('./components/TailwindFiddle.vue'));

window.app = new Vue({
    el: '#app'
});
