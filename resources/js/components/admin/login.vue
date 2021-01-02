<template>
    <v-row justify="center">
        <v-dialog
            v-model="dialog"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-form ref="form">
                    <v-card-text>
                        <v-container>
                            <v-row>

                                <v-col cols="12">
                                    <v-text-field
                                        label="نام کاربری"
                                        v-model="username"
                                        :rules="usernameRules"
                                        :counter="20"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        label="کلمه عبورد"
                                        v-model="password"
                                        :rules="passwordRules"
                                        :counter="20"
                                        type="password"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="success"
                            @click="formValidate()"
                        >
                            <v-icon
                                right
                                dark
                            >
                                mdi-lock-open-outline
                            </v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
export default {
    name: "login",
    data: () => ({
        dialog: true,
        username: '',
        password: '',
        usernameRules: [
            v => !!v || 'لطفا نام کاربری خود را وارد نمایید',
            v => v.length >= 3 || 'نام کاربری باید حداقل 3 کاراکتر باشد',
        ],
        passwordRules: [
            v => !!v || 'لطفا کلمه عبور خود را وارد نمایید',
            v => v.length >= 3 || 'کلمه عبور باید حداقل 3 کاراکتر باشد',
        ],

    }), methods: {
        loader() {
            axios.post('api/user/checkLogin', {
                username: this.username,
                password: this.password,
            }).then((response) => {
                if (response.data.status === 0) {
                    Swal.fire({
                        title: response.data.title,
                        text: response.data.message,
                        icon: response.data.type,
                        confirmButtonText: 'تمام'
                    })
                } else {
                    localStorage.admin = 1;
                    location.replace('/')
                    this.dialog = false;
                }
                this.loading = false
            }).catch((error) => {
                Swal.fire({
                    title: 'خطا',
                    text: 'عملیات با خطا موجه شد',
                    icon: 'error',
                    confirmButtonText: 'تمام'
                })
            })
        },
        formValidate() {
            if (this.$refs.form.validate()) {
                this.loader()
            }
        }
    }, beforeMount() {
        if (localStorage.admin === '1') {
            this.dialog = false
        }
    }
}
</script>

<style scoped>

</style>
