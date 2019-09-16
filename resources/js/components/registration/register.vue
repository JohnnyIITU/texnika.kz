<template>
    <li class="top-header-nav__item">
        <div class="dropdown">
            <a href="#" role="button" id="dropdownRegisterLink" class="top-header-nav__link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Регистрация
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownRegisterLink">
                <h3 class="mb-4">Регистрация</h3>
                <form>
                    <div class="form-group mb-3">
                        <input type="text" v-model="username" class="form-control" placeholder="Телефон или e-mail">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" v-model="password" class="form-control" placeholder="Пароль">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" v-model="password_confirm" class="form-control" placeholder="Пароль еще раз">
                    </div>
                    <div class="form-group mb-3 error" v-if="error">
                        <p>{{error_text}}</p>
                    </div>

                    <div class="form-group mb-3">
                        <button type="button" @click="register" class="btn btn-warning btn-sm btn-block">Зарегистрироваться</button>
                    </div>
                    <ul class="social-links mb-3">
                        <li><a href="#" class="icon-facebook">facebook</a></li>
                        <li><a href="#" class="icon-vk">vk</a></li>
                        <li><a href="#" class="icon-google">google</a></li>
                    </ul>
                </form>
                <p class="mb-0 small"><a href="#">Политика конфиденциальности</a></p>
                <p class="mb-0 small"><a href="#">Пользовательское соглашение</a></p>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "register",
        data() {
            return {
                username: '',
                password: '',
                password_confirm: '',
                error_text : '',
                error: false,
                username_checked: null,
            }
        },
        methods: {
            register: function(){
                this.validate();

                if(this.error){
                    return;
                }

                this.changeError();

                this.axios.post("/register", {username : this.username, password: this.password}).then((response) => {
                    this.checkRegister(response.data);
                });

            },
            validate: function () {
                if(this.password !== this.password_confirm){
                    this.error = true;
                    this.error_text = 'Введенные вами пароли не совпадают';
                    return false;
                }

                if(this.password.length < 8){
                    this.error = true;
                    this.error_text = 'Пароль не должен быть меньше 8 символов';
                    return false;
                }

                this.checkUsername();

                return this.error;
            },
            checkUsername: function () {
                this.axios.post("/checkUsername", {username : this.username}).then((response) =>
                    this.checkUsernameResponse(response.data)
                );
            },
            checkUsernameResponse: function (response) {
                if(response.state !== 1){
                    this.error = true;
                    this.error_text = 'Такой e-mail/номер уже зарегистрирован';
                }
            },
            changeError: function () {
                this.error = false;
                this.error_text = '';
            },
            checkRegister: function (response) {
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
            'password_confirm' : ['changeError'],
        }

    }
</script>
