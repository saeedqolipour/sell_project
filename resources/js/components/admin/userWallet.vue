<template>
    <div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-container>
                <h1 class="mb-5">مشاهده موجودی کاربر</h1>
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
                    </v-col>
                </v-row>
                <v-btn
                    depressed
                    color="success"
                    @click="formValidate()"
                >
                    <v-icon
                        dark
                        class="ml-2"
                    >
                        mdi-database-search
                    </v-icon>
                    جستجوی کاربر
                    <template v-slot:loader>
                        <span>لطفا صبر کنید ...</span>
                    </template>
                </v-btn>
            </v-container>
        </v-form>
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
                            موجودی : {{ userWallet }} تومان
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="green"
                                text
                                @click="dialog = false"
                            >
                                تمام
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </template>
    </div>
</template>

<script>
export default {
    name: "userWallet",
    data: () => ({
        valid: null,
        nationalCode: '',
        nameAndFamily: '',
        dialog: false,
        userWallet: 0,
        nationalCodeRules: [
            v => !!v || 'لطفا کد ملی کاربر را وارد نمایید',
            v => v.length <= 10 || 'کد ملی باید 10 رقم باشد !',
            v => v.length >= 10 || 'کد ملی باید 10 رقم باشد !',
        ],
    }), methods: {
        searchUser() {
            if (localStorage.admin) {
                axios.post('api/user/wallet', {
                    nationalCode: this.nationalCode
                }).then((response) => {
                    if (response.data.wallet || response.data.wallet === 0) {
                        this.userWallet = response.data.wallet
                        this.nameAndFamily = response.data.nameAndFamily
                        this.dialog = true;
                    } else {
                        Swal.fire({
                            title: response.data.title,
                            text: response.data.message,
                            icon: response.data.type,
                            confirmButtonText: 'تمام'
                        })
                    }
                }).catch((error) => {
                    Swal.fire({
                        title: 'خطا',
                        text: 'عملیات با خطا موجه شد',
                        icon: 'error',
                        confirmButtonText: 'تمام'
                    })
                })
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
                this.searchUser()
            }
        }
    }
}
</script>
