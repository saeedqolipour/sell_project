<template>
    <div>
        <v-container>
            <h1 class="mb-5">ثبت سفارش</h1>
            <v-row>
                <v-col cols="12">
                    <v-autocomplete
                        v-model="selectedUser"
                        :items="users"
                        :item-text="'national_code'"
                        :item-value="'id'"
                        label="جستجوی کاربر بر اساس کد ملی"
                        solo
                    ></v-autocomplete>
                    <v-autocomplete
                        v-model="selectedProducts"
                        :items="products"
                        :item-text="productText"
                        :item-value="'id'"
                        chips
                        label="انتخاب محصول"
                        multiple
                        solo
                    >
                    </v-autocomplete>
                </v-col>
            </v-row>
            <v-btn
                depressed
                color="success"
                @click="showSaveOrderDialog()"
            >
                <v-icon
                    dark
                    class="ml-2"
                >
                    mdi-cart
                </v-icon>
                مشاهده فاکتور + پرداخت
                <template v-slot:loader>
                    <span>لطفا صبر کنید ...</span>
                </template>
            </v-btn>
            <template>
                <v-row justify="center">
                    <v-dialog
                        v-model="dialog"
                        persistent
                        max-width="400"
                    >
                        <v-card>
                            <v-card-title class="headline">
                                {{ nameAndFamily }}
                            </v-card-title>
                            <v-card-text>
                                جمع کل خرید : {{ totalPrice }} تومان
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    class="mb-2"
                                    color="black"
                                    text
                                    @click="dialog = false"
                                >
                                    انصراف
                                </v-btn>
                                <v-btn
                                    class="mb-2"
                                    color="success"
                                    @click="saveOrder"
                                >
                                    ثبت نهایی سفارش
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-row>
            </template>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "submitOrder",
    data: () => ({
        products: [],
        selectedUser: [],
        nameAndFamily: '',
        totalPrice: 0,
        users: [],
        selectedProducts: [],
        dialog: false,
        value: null,
    }), methods: {
        showSaveOrderDialog() {
            console.log(this.selectedProducts)
            if (this.selectedProducts.length === 0 || this.selectedUser.length === 0) {
                Swal.fire({
                    title: 'خطا',
                    text: 'لطفا تمام فیلد ها را تکمیل نمایید',
                    icon: 'error',
                    confirmButtonText: 'تمام'
                })
            } else {
                axios.post('api/product/getOrderProducts', {
                    orders: this.selectedProducts,
                    userId: this.selectedUser
                }).then((response) => {
                    if (response.data.status === 0) {
                        Swal.fire({
                            title: 'عدم موجودی کافی',
                            text: 'موجودی کاربر : ' + response.data.wallet + ' تومان ',
                            icon: 'error',
                            confirmButtonText: 'تمام'
                        })
                    } else {
                        this.totalPrice = response.data.totalPrice
                        this.nameAndFamily = response.data.user.first_name + ' ' + response.data.user.last_name
                        this.dialog = true
                    }
                }).catch((error) => {
                    console.log("error")
                });
            }
        },
        productText(item) {
            return `${item.product_name} • ${item.product_price} تومان `
        },
        saveOrder() {
            axios.post('api/orders', {
                orders: this.selectedProducts,
                userId: this.selectedUser
            }).then((response) => {
                Swal.fire({
                    title: response.data.title,
                    text: response.data.message,
                    icon: response.data.type,
                    confirmButtonText: 'تمام'
                })
                this.dialog = false
            }).catch((error) => {
                console.log("error")
            });
        }
    }, beforeMount() {
        axios.get('api/product').then((response) => {
            this.products = response.data.products
        }).catch((error) => {
            Swal.fire({
                title: 'خطا',
                text: 'عملیات با خطا موجه شد',
                icon: 'error',
                confirmButtonText: 'تمام'
            })
        })
        axios.get('api/user').then((response) => {
            this.users = response.data.users
        }).catch((error) => {
            Swal.fire({
                title: 'خطا',
                text: 'عملیات با خطا موجه شد',
                icon: 'error',
                confirmButtonText: 'تمام'
            })
        })
    }
}
</script>

<style scoped>

</style>
