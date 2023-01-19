
require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import AddressList from './components/AddressList.vue';
import UserList from './components/UserList.vue';

window.Vue = require('vue').default;
Vue.use(VueRouter);


const router = new VueRouter ({
    mode: 'history',
    routes: [
        {
            path: '/addresses',
            name: 'address.list',
            component: AddressList,
        },
        {
            path: '/users',
            name: 'user.list',
            component: UserList,
        }
    ]
});

const app = new Vue({
    el: '#app',
    router,
});
