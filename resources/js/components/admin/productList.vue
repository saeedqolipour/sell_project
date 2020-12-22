<template>
    <div>
        <v-container>
            <h1 class="mb-5">لیست محصولات</h1>
            <v-row>
                <v-col>
                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                            <tr>
                                <th class="text-right">
                                    ردیف
                                </th>
                                <th class="text-right">
                                    نام محصول
                                </th>
                                <th class="text-right">
                                    قیمت محصول
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="product in products"
                                :key="product.id"
                            >
                                <td>{{ product.id }}</td>
                                <td>{{ product.product_name }}</td>
                                <td>{{ product.product_price }}</td>
                            </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
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
    }
}
</script>
