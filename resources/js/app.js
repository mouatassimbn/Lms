/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import 'bootstrap/dist/js/bootstrap.bundle'; // import bootstrap
require('./bootstrap'); // require bootrstap.js file

import store  from './store/index.js'; // Import state
import VueResource from 'vue-resource'; // import vue-ressource

window.Vue = require('vue'); // use Vuejs
Vue.config.productionTip = false; // turn off production tip concole.log
Vue.use(VueResource); // append vue-ressource to vue
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};

// Import componnents
import calendar from './components/calendar.vue';
import reserve from './components/reserveButton.vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('calendar', require('./components/calendar.vue').default);
// Vue.component('reserve', require('./components/reserveButton.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    components : {
        calendar,
        reserve
    }
});
