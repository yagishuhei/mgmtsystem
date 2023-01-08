import Router from 'vue-router';
import About from './components/About.vue';

export default new Router ({
    mode: 'history',
    routes: [
        {
            path: '/about',
            name: 'about',
            component: About,
        }
    ]
});