
require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import AddressList from './components/AddressList.vue';
import UserList from './components/UserList.vue';

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.component('address-list', AddressList);

const router = new VueRouter ({
    mode: 'history',
    routes: [
        {
            path: '/addresses',
            name: 'address.list',
            component: AddressList,
        }
    ]
});

const app = new Vue({
    el: '#app',
    router,
});
