<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            app
            right
        >
            <v-list>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-subtitle>پروژه آموزشی ویو جی اس</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list
                nav
                dense
            >
                <v-list-item-group :style="style"
                                   v-model="selectedItem"
                                   color="primary"
                >
                    <v-list-item
                        v-for="(item, i) in items"
                        :key="i"
                        :to="item.to"
                    >
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>سامانه ثبت اطلاعات فروش</v-toolbar-title>
        </v-app-bar>
        <v-main :style="style">
            <v-container>
                <v-row>
                    <v-col class="lg-12 md-12">
                        <router-view></router-view>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <loginForm></loginForm>
    </v-app>
</template>

<script>
import Login from './admin/login'

export default {
    data: () => ({
        drawer: null,
        selectedItem: 0,
        style: '',
        items: [
            {text: 'صفحه اصلی', icon: 'mdi-home', to: '/'},
            {text: 'افزودن کاربر', icon: 'mdi-account', to: '/addUser'},
            {text: 'افزایش موجودی', icon: 'mdi-credit-card-plus', to: '/walletCharge'},
            {text: 'مشاهده موجودی کاربر', icon: 'mdi-credit-card', to: '/userWallet'},
            {text: 'افزودن محصول', icon: 'mdi-plus-box-outline', to: '/addProduct'},
            {text: 'لیست محصولات', icon: 'mdi-view-module', to: '/productList'},
            {text: 'ثبت سفارش', icon: 'mdi-cart-plus', to: '/submitOrder'},
            {text: 'گزارشات', icon: 'mdi-chart-bar', to: '/reports'},
            {text: 'قفل پنل کاربری', icon: 'mdi-lock', to: '/lock'}
        ],
    }), components: {
        'loginForm': Login
    }, beforeMount() {
        if (localStorage.admin) {
            this.style = '';
        } else {
            this.style = 'filter:blur(10px)';
        }
    }
}
</script>


