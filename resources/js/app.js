/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import 'bootstrap/dist/js/bootstrap.bundle'; // import bootstrap
import Vuex from 'vuex'; // import vuex

require('./bootstrap');

window.Vue = require('vue'); // use Vuejs

var VueResource = require('vue-resource'); // import vue-ressource
Vue.use(VueResource); // append vue-ressource to vue
Vue.use(Vuex); // append vuex to vue
Vue.config.productionTip = false; // turn off production tip concole.log

Vue.http.options.root = '/root';
Vue.http.headers.common['Authorization'] = 'Basic YXBpOnBhc3N3b3Jk';

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
Vue.component('calendar', require('./components/calendar.vue').default);
Vue.component('reserve', require('./components/reserveButton.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


// let button = document.getElementById("reservationButton");
// button.onclick = function () {
//     cal.methods.outText();
// };
