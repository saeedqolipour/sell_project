<template>
    <div>
        <v-container>
            <h1 class="mb-5">گزارشات</h1>
            <v-row>
                <v-col>
                    <template>
                        <v-card>
                            <v-card-title>
                                لیست کاربران + گزارش خرید
                                <v-spacer></v-spacer>
                                <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="جستجوی کاربر ..."
                                    single-line
                                    solo
                                    hide-details
                                ></v-text-field>
                            </v-card-title>
                            <v-data-table
                                :headers="headers"
                                :items="users"
                                :search="search"
                                :footer-props="{'items-per-page-text':'نمایش کاربران در هر صفحه'}"
                            >
                                <template v-slot:item.fullName="{ item }">
                                    {{ item.first_name }} {{ item.last_name }}
                                </template>
                                <template v-slot:item.orderReport="{ item }">
                                    <v-btn
                                        x-small
                                        color="primary"
                                        @click="showReport(item)"
                                    >
                                        مشاهده
                                    </v-btn>
                                </template>
                                <template v-slot:no-data>
                                    هیچ گزارشی جهت نمایش وجود ندارد
                                </template>
                            </v-data-table>
                        </v-card>
                    </template>
                    <template>
                        <v-dialog
                            v-model="dialog"
                            max-width="600"
                        >
                            <template>
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
                                                مبلغ خرید
                                            </th>
                                            <th class="text-right">
                                                تاریخ
                                            </th>
                                            <th class="text-right">
                                                ساعت
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr
                                            v-for="(item, index) in products"
                                            :key="item.id"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.product }}</td>
                                            <td>{{ item.price }}</td>
                                            <td>{{ item.date }}</td>
                                            <td>{{ item.time }}</td>
                                        </tr>
                                        </tbody>
                                    </template>
                                </v-simple-table>
                            </template>
                        </v-dialog>
                    </template>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "reports",
    data() {
        return {
            users: [],
            dialog: false,
            search: '',
            nameAndFamily: '',
            products: [],
            headers: [
                {text: 'ردیف', sortable: false, value: 'id'},
                {text: 'نام و نام خانوادگی', value: 'fullName'},
                {text: 'شماره همراه', value: 'mobile_number'},
                {text: 'کد ملی', value: 'national_code'},
                {text: 'گزارش خرید', value: 'orderReport'},
            ],
        }
    }, methods: {
        showReport(item) {
            axios.post('api/user/getReport', {
                userId: item.id
            }).then((response) => {
                this.products = response.data.orders
                console.log(this.products);
            }).catch((error) => {
                Swal.fire({
                    title: 'خطا',
                    text: 'عملیات با خطا موجه شد',
                    icon: 'error',
                    confirmButtonText: 'تمام'
                })
            });
            this.dialog = true
        }
    },
    beforeMount() {
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
