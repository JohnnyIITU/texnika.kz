<template>
    <li class="top-header-nav__item">
        <div class="dropdown">
            <a href="#" role="button" id="dropdownLoginLink" class="top-header-nav__link"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Вход
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownLoginLink">
                <h3 class="mb-4">Вход</h3>
                <form>
                    <div class="form-group mb-3">
                        <input v-model="username" type="text" class="form-control"
                               placeholder="Телефон или e-mail">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" v-model="password" class="form-control" placeholder="Пароль">
                    </div>
                    <p class="mb-3 small"><a href="#">Восстановить пароль</a></p>
                    <div class="form-group mb-3">
                        <button type="button" @click="login" class="btn btn-warning btn-sm btn-block">Войти
                        </button>
                    </div>
                    <ul class="social-links mt-3">
                        <li><a href="#" class="icon-facebook">facebook</a></li>
                        <li><a href="#" class="icon-vk">vk</a></li>
                        <li><a href="#" class="icon-google">google</a></li>
                    </ul>
                </form>
            </div>
        </div>
    </li>

</template>

<script>
    export default {
        name: "login",
        data() {
            return {
                username: '',
                password: '',
                error_text : '',
                error: false,
            }
        },
        methods: {
            login: function(){
                this.axios.post("/login", {username : this.username, password: this.password}).then((response) => {
                    this.checkLogin(response.data)
                });

            },
            changeError: function () {
                this.error = false;
                this.error_text = '';
            },
            checkLogin: function (response) {
                this.error = response.error;
                this.error_text = response.error_text;

                if(!this.error){
                    location.reload();
                }
            }
        },
        watch: {
            'username' : ['changeError'],
            'password' : ['changeError'],
        }

    }
</script>
