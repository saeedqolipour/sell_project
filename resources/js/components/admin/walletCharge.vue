<template>
    <div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-container>
                <h1 class="mb-5">افزایش موجودی</h1>
                <v-row>
                    <v-col>
                        <v-text-field
                            v-model="nationalCode"
                            label="کد ملی"
                            :rules="nationalCodeRules"
                            :counter="10"
                            type="number"
                            min="0"
                            solo
                            append-icon="mdi-qrcode"
                        ></v-text-field>
                        <v-text-field
                            v-model="walletCharge"
                            :rules="walletChargeRules"
                            :counter="10"
                            step="1000"
                            label="مقدار افزایش (تومان)"
                            type="number"
                            min="0"
                            solo
                            append-icon="mdi-credit-card-plus"
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
                        mdi-credit-card-plus
                    </v-icon>
                    افزایش موجودی
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
    name: "addUser",
    data() {
        return {
            valid: true,
            nationalCode: '',
            walletCharge: '',
            loading: false,
            walletId: 0,
            nationalCodeRules: [
                v => !!v || 'لطفا کد ملی کاربر را وارد نمایید',
                v => v.length <= 10 || 'کد ملی باید 10 رقم باشد !',
                v => v.length >= 10 || 'کد ملی باید 10 رقم باشد !',
            ],
            walletChargeRules: [
                v => !!v || 'لطفا مقدار افزایش را وارد نمایید',
                v => v.length >= 4 || 'مبلغ افزایش باید بیشتر از 1000 تومان باشد',
            ],
        }
    }, methods: {
        formValidate() {
            if (this.$refs.form.validate()) {
                axios.post('api/wallet', {
                    nationalCode: this.nationalCode,
                    chargeValue: this.walletCharge,
                }).then((response) => {
                    Swal.fire({
                        title: response.data.title,
                        text: response.data.message,
                        icon: response.data.type,
                        confirmButtonText: 'تمام'
                    })
                    this.$refs.form.reset()
                    this.loading = false
                }).catch((error) => {
                    console.log('Error')
                })
            }
        },
    },
}
</script>

<style scoped>

</style>
