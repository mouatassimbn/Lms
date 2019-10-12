import Vuex from 'vuex';
import Vue from 'vue';
//import 'es6-promise/auto';
import reservations from './modules/reservations';
// Load Vuex
Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        reservations
    }
});

export default store;