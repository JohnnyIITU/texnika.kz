<template>
    <div class="container">
        <form>
            <!-- begin row -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Подать объявление</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 text-lg-right d-none d-lg-block">
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="btn btn-warning btn-block mb-3" type="button" @click="trashSave">Сохранить в черновик</button>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-warning btn-block mb-3" type="button" @click="save">Опубликовать</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row mb-2">
                <div class="col">
                    <h1 class="title-page">На продажу</h1>
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row align-items-stretch mb-5">
                <div class="col-lg-5 col-sm-12">
                    <div class="form-group">
                        <select class="form-control select-css" name="region" v-model="city">
                            <option v-for="key in cityOptions" :value="key.key">{{key.label}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control select-css" name="typeTransport" v-model="type">
                            <option v-for="key in typeOptions" :value="key.key">{{key.label}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control select-css" name="brand" v-model="mark">
                            <option v-for="key in markOptions" :value="key.key">{{key.label}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="model" v-model="model" placeholder="Модель">
                    </div>
                    <div class="form-group">
                        <select class="form-control select-css" id="selectYear" v-model="year">
                            <option v-for="key in yearOptions" :value="key.key">{{key.label}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control select-css" v-model="condition">
                            <option v-for="key in conditionOptions" :value="key.key">{{key.label}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" v-mask="'+7(7##)###-##-##'" placeholder="Номер телефона" v-model="phone">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" v-model="email">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-9 col-8 mb-lg-0">
                            <input type="number" step="100" class="form-control" v-model="price" name="price" placeholder="Цена">
                        </div>
                        <div class="form-group col-lg-3 col-4 mb-lg-0">
                            <select class="form-control select-css" name="currency" v-model="curr">
                                <option value="1">KZT</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-12">
                    <textarea class="form-control" name="description" v-model="description" placeholder="Описание и характеристики"></textarea>
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <upload-image
                :files="files"
                :images="images"
                :activeIndex.sync="activeIndex"
            ></upload-image>
            <!-- end row -->
            <!-- begin row -->
            <div class="row d-lg-none">
                <div class="col-12 col-sm-6">
                    <button class="btn btn-primary btn-block mb-3" type="button" @click="trashSave">Сохранить в черновик</button>
                </div>
                <div class="col-12 col-sm-6">
                    <button class="btn btn-primary btn-block mb-3" type="button" @click="save">Опубликовать</button>
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>
</template>

<script>
    export default {
        name: "sale",
        data() {
            return {
                activeIndex: 0,
                files: [],
                images: [],
                city: 0,
                type: 0,
                mark: 0,
                model: '',
                year: 2010,
                condition: 1,
                price : null,
                curr : 1,
                phone: '',
                email: '',
                markOptions: [],
                yearOptions: [],
                cityOptions: [],
                typeOptions: [],
                conditionOptions: [],
                description: '',
                authenticated: false,
            }
        },
        mounted: function(){
            this.getCityOptions();
            this.getTypeOptions();
            this.getMarkOptions();
            this.getYearOptions();
            this.getConditionOptions();
            this.checkAuth();
        },
        methods: {
            checkAuth() {
                this.axios.get('/checkAuth', {}).then(response => {
                    this.authenticated = response.data;
                });
            },            getCityOptions: function () {
                this.axios.post('/getCityList', {}).then((response) => {
                    this.cityOptions = response.data;
                    this.cityOptions.unshift({
                        key : 0,
                        label : 'Город',
                        class : '',
                    });
                });
            },
            getTypeOptions: function () {
                this.axios.post('/getTypeList', {}).then((response) => {
                    this.typeOptions = response.data;
                    this.typeOptions.unshift({
                        key : 0,
                        label : 'Тип техники',
                        class : '',
                    });
                });
            },
            getMarkOptions: function () {
                this.axios.post('/getMarkList', {}).then((response) => {
                    this.markOptions = response.data;
                    this.markOptions.unshift({
                        key : 0,
                        label : 'Марка',
                        class : '',
                    });
                });
            },
            getYearOptions: function () {
                this.axios.post('/getYearList', {}).then((response) => {
                    this.yearOptions = response.data;
                });
            },
            getConditionOptions: function () {
                this.axios.post('/sale/getConditionOptions', {}).then(response => {
                    response.data.splice(3,1);
                    this.conditionOptions = response.data;
                    this.conditionOptions.unshift({
                        key : 0,
                        label : 'Состояние',
                        class : '',
                    });
                });
            },
            trashSave: function() {
                this.$root.preloader(true);
                if(this.authenticated) {
                this.axios.post('/sale/saveToTrash', this.createResponseData())
                    .then((response) => {
                        this.fetchResponse(response.data)
                    })
                    .catch(error => {
                        this.$root.preloader(false);
                        alert(error);
                    });
                }else{
                    alert('Вам необходимо зарегистрироваться')
                }
            },
            save: function () {
                this.$root.preloader(true);
                this.axios.post('/sale/save', this.createResponseData())
                    .then((response) => {
                        this.fetchResponse(response.data)
                    })
                    .catch(error => {
                        this.$root.preloader(false);
                        alert(error);
                    });
            },
            fetchResponse: function(response) {
                if(response.error){
                    this.$root.preloader(false);
                    alert(response.error_text);
                }else{
                    window.location.href = '/';
                }
            },
            createResponseData: function () {
                const formData = new FormData;

                this.files.forEach(file => {
                    formData.append('images[]', file, file.name);
                });

                formData.append('mark', this.mark);
                formData.append('model', this.model);
                formData.append('year', this.year);
                formData.append('city', this.city);
                formData.append('type', this.type);
                formData.append('phone', this.phone);
                formData.append('email', this.email);
                formData.append('price', this.price);
                formData.append('curr', this.curr);
                formData.append('condition', this.condition);
                formData.append('description', this.description);
                formData.append('preview', this.images[this.activeIndex]);
                return formData;
            },
        },
        watch: {
            'username' : ['changeError'],
            'password' : ['changeError'],
            'password_confirm' : ['changeError'],
        }

    }
</script>
