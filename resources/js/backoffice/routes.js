import Vue from 'vue';
import VueRouter from 'vue-router'
import Pages from './pages'

const routes = []
routes.push.apply(routes, Pages);

Vue.use(VueRouter);

export default new VueRouter({
    routes // short for `routes: routes`
})