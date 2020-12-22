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
                        label="جستجوی کاربر"
                        solo
                    ></v-autocomplete>
                    <v-autocomplete
                        v-model="selectedProducts"
                        :items="products"
                        :item-text="'product_name'"
                        :item-value="'id'"
                        chips
                        label="انتخاب محصول"
                        multiple
                        solo
                    ></v-autocomplete>
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
                    mdi-account-box
                </v-icon>
                ثبت سفارش کاربر
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
                                    color="success"
                                    @click="dialog = false"
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
        nameAndFamily: 'سعید قلی پور',
        totalPrice: 0,
        nationalCode: 0,
        users: [],
        selectedProducts: [],
        dialog: false,
        value: null,
    }), methods: {
        showSaveOrderDialog() {
            console.log(this.selectedProducts)
            this.dialog = true
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
