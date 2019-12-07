<template>
    <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
        <div class="login100-form validate-form">
            <span class="login100-form-title p-b-55">
                ADMIN
            </span>

            <div class="wrap-input100 validate-input m-b-16">
                <input class="input100" type="text" v-model="username" placeholder="Имя пользователя">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
            </div>

            <div class="wrap-input100 validate-input m-b-16">
                <input class="input100" v-model="password" type="password" placeholder="Пароль">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
            </div>

            <div class="container-login100-form-btn p-t-25">
                <button class="login100-form-btn" @click="login">
                    Войти
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",
        data() {
            return {
                username : '',
                password : '',
            }
        },
        methods: {
            login () {
                this.axios.post('/login', {username: this.username, password: this.password})
                    .then((response) => {
                        this.afterLogin(response.data)
                    })
                    .catch(response => {
                        alert(response);
                        this.preloader(false)
                    })
            },
            afterLogin (response){
                if(response.success){
                    location.href = "/index";
                }else{
                    this.showErrorMessage(response.error);
                }
            }
        },
    }


</script>