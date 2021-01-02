<template>
    <div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-container>
                <h1 class="mb-5">افزودن کاربر</h1>
                <v-row>
                    <v-col>
                        <v-text-field
                            label="نام"
                            v-model="firstName"
                            solo
                            append-icon="mdi-account-box-outline"
                            :rules="firstNameRules"
                            :counter="15"
                            :maxlength="15"
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="lastName"
                            :rules="lastNameRules"
                            :counter="15"
                            :maxlength="15"
                            label="نام خانوادگی"
                            solo
                            append-icon="mdi-account-box-outline"
                        ></v-text-field>
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
                            v-model="mobileNumber"
                            :rules="mobileNumberRules"
                            :counter="11"
                            label="شماره همراه"
                            type="number"
                            min="0"
                            solo
                            append-icon="mdi-cellphone-iphone"
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
                    ثبت اطلاعات کاربر
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
            firstName: '',
            lastName: '',
            nationalCode: '',
            mobileNumber: '',
            loading: false,
            firstNameRules: [
                v => !!v || 'لطفا نام کاربر را وارد نمایید',
                v => v.length >= 3 || 'نام کاربر باید حداقل 3 کاراکتر باشد',
            ],
            lastNameRules: [
                v => !!v || 'لطفا نام خانوادگی کاربر را وارد نمایید',
                v => v.length >= 3 || 'نام کاربر باید حداقل 3 کاراکتر باشد',
            ],
            nationalCodeRules: [
                v => !!v || 'لطفا کد ملی کاربر را وارد نمایید',
                v => v.length <= 10 || 'کد ملی باید 10 رقم باشد !',
                v => v.length >= 10 || 'کد ملی باید 10 رقم باشد !',
            ],
            mobileNumberRules: [
                v => !!v || 'لطفا شماره همراه کاربر را وارد نمایید',
                v => v.length <= 11 || 'شماره همراه باید 11 رقم باشد !',
                v => v.length >= 11 || 'شماره همراه باید 11 رقم باشد !',
            ],
        }
    }, methods: {
        loader() {
            this.loading = true;
            if (localStorage.admin) {
                axios.post('api/user', {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    nationalCode: this.nationalCode,
                    mobileNumber: this.mobileNumber,
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
            } else {
                Swal.fire({
                    title: 'خطا',
                    text: 'دسترسی غیر مجاز',
                    icon: 'error',
                    confirmButtonText: 'تمام'
                })
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
