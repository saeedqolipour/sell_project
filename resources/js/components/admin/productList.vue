<template>
    <div>
        <v-container>
            <h1 class="mb-5">لیست محصولات</h1>
            <v-row>
                <v-col>
                    <template>
                        <v-card>
                            <v-card-title>
                                لیست محصولات و قیمت ها
                                <v-spacer></v-spacer>
                                <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="جستجوی محصول ..."
                                    single-line
                                    solo
                                    hide-details
                                ></v-text-field>
                            </v-card-title>
                            <v-data-table
                                :headers="headers"
                                :items="products"
                                :search="search"
                                :footer-props="{'items-per-page-text':'نمایش محصولات در هر صفحه'}"
                            ></v-data-table>
                        </v-card>
                    </template>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "productList",
    data() {
        return {
            products: [],
            search: '',
            headers: [
                {text: 'ردیف', sortable: false, value: 'id'},
                {text: 'نام محصول', value: 'product_name'},
                {text: 'قیمت محصول', value: 'product_price'},
            ],
        }
    }
    ,
    beforeMount() {
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
    }
}
</script>
