<template>
    <div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-container>
                <h1 class="mb-5">افزودن محصول</h1>
                <v-row>
                    <v-col>
                        <v-text-field
                            label="نام محصول"
                            v-model="productName"
                            solo
                            append-icon="mdi-account-box-outline"
                            :rules="productRules"
                            :counter="50"
                            :maxLength="50"
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="productPrice"
                            :rules="productPriceRules"
                            :counter="10"
                            type="number"
                            label="قیمت محصول"
                            step="1000"
                            min="0"
                            solo
                            append-icon="mdi-account-box-outline"
                        ></v-text-field>

                    </v-col>
                </v-row>
                <v-btn
                    depressed
                    color="success"
                    :loading="loading"
                    @click="formValidate()"
                >
                    <v-icon
                        dark
                        class="ml-2"
                    >
                        mdi-account-box
                    </v-icon>
                    ثبت اطلاعات محصول
                    <template v-slot:loader>
                        <span>لطفا صبر کنید ...</span>
                    </template>
                </v-btn>
            </v-container>
        </v-form>
    </div>
</template>

<script>
export default {
    name: "addProduct",
    data() {
        return {
            valid: true,
            productName: '',
            productPrice: '',
            nationalCode: '',
            mobileNumber: '',
            loading: false,
            productRules: [
                v => !!v || 'لطفا نام محصول را وارد نمایید',
                v => v.length >= 3 || 'نام محصول باید حداقل 3 کاراکتر باشد',
            ],
            productPriceRules: [
                v => !!v || 'لطفا قیمت محصول را وارد نمایید',
                v => v.length >= 4 || 'قیمت محصول باید حداقل 1,000 تومان  باشد',
            ],
        }
    }, methods: {
        loader() {
            this.loading = true;
            if (localStorage.admin) {
                axios.post('api/product', {
                    productName: this.productName,
                    productPrice: this.productPrice,
                }).then((response) => {
                    Swal.fire({
                        title: response.data.title,
                        text: response.data.message,
                        icon: response.data.type,
                        confirmButtonText: 'تمام'
                    })
                    this.loading = false
                }).catch((error) => {
                    Swal.fire({
                        title: 'خطا',
                        text: 'عملیات با خطا موجه شد',
                        icon: 'error',
                        confirmButtonText: 'تمام'
                    })
                })
                this.loading = false
            }
        },
        formValidate() {
            if (this.$refs.form.validate()) {
                this.loader()
            }
        },
    },
}
</script>

<style scoped>

</style>
