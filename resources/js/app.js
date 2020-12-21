require('./bootstrap');
import Vue from "vue";
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
Vue.use(VueRouter)

Vue.component('test-page', require('./components/test').default);

const routes = [
    {path: '/userWallet', component: require('./components/admin/userWallet').default},
    {path: '/addUser', component: require('./components/admin/addUser').default},
    {path: '/addProduct', component: require('./components/admin/addProduct').default},
    {path: '/submitOrder', component: require('./components/admin/submitOrder').default},
    {path: '/productList', component: require('./components/admin/productList').default},
    {path: '/reports', component: require('./components/admin/reports').default},
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        rtl: true,
        icons: {
            iconfont: 'mdi',
        },
    }),
    router,
});
