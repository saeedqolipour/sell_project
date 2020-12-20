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
    {path: '/foo', component: require('./components/ExampleComponent').default},
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        rtl:true,
        icons: {
            iconfont: 'mdi',
        },
    }),
    router,
});
