/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const routes = [
    { path: '/', component: require('./components/index.vue').default },
    { path: '/profil', component: require('./components/profil/profil.vue').default },
    { path: '/createAMonster', component: require('./components/monster/createAMonster.vue').default }, // not work
    { path: '/getAMonster', component: require('./components/monster/showAMonster.vue').default }, // not work
    { path: '/warAMonster', component: require('./components/monster/warAMonster.vue').default }, // not work
];
const router = new VueRouter({ routes });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    mounted() {
        console.log('Component mounted.');
    },
});