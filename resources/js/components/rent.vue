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
                            <button class="btn btn-warning btn-block mb-3" type="button" ref="btnTrash" @click="trashSave">Сохранить в черновик</button>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-warning btn-block mb-3" type="button" ref="btnSave" @click="save">Опубликовать</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row mb-2">
                <div class="col">
                    <h1 class="title-page">В аренду</h1>
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
                        <input type="text" class="form-control" name="phone" placeholder="Номер телефона" v-model="phone">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" v-model="email">
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
                    <button class="btn btn-primary btn-block mb-3" type="button" ref="btnTrashMob" @click="trashSave">Сохранить в черновик</button>
                </div>
                <div class="col-12 col-sm-6">
                    <button class="btn btn-primary btn-block mb-3" type="button" ref="btnSaveMob" @click="save">Опубликовать</button>
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>
</template>

<script>
    export default {
        name: "rent",
        data() {
            return {
                activeIndex: 0,
                files: [],
                images: [],
                city: 1,
                type: 1,
                mark: 1,
                model: '',
                year: 2010,
                price : null,
                curr : 1,
                phone: '',
                email: '',
                markOptions: [],
                yearOptions: [],
                cityOptions: [],
                typeOptions: [],
                description: '',
            }
        },
        mounted: function(){
            this.getCityOptions();
            this.getTypeOptions();
            this.getMarkOptions();
            this.getYearOptions();
        },
        methods: {
            getCityOptions: function () {
                this.axios.post('/getCityList', {}).then((response) => {
                    this.cityOptions = response.data;
                });
            },
            getTypeOptions: function () {
                this.axios.post('/getTypeList', {}).then((response) => {
                    this.typeOptions = response.data;
                });
            },
            getMarkOptions: function () {
                this.axios.post('/getMarkList', {}).then((response) => {
                    this.markOptions = response.data;
                });
            },
            getYearOptions: function () {
                this.axios.post('/getYearList', {}).then((response) => {
                    this.yearOptions = response.data;
                });
            },
            trashSave: function() {
                this.axios.post('/rent/saveToTrash', this.createResponseData())
                    .then((response) => {
                        this.fetchResponse(response.data)
                    })
                    .catch(error => {
                        alert(error)
                    });
            },
            save: function () {
                this.$refs.btnTrash.disabled = true;
                this.$refs.btnTrashMob.disabled = true;
                this.$refs.btnSave.disabled = true;
                this.$refs.btnSaveMob.disabled = true;
                var vm = this;
                this.axios.post('/rent/save', this.createResponseData())
                    .then((response) => {
                        this.fetchResponse(response.data)
                    })
                    .catch(error => {
                        alert(error)
                        this.$refs.btnTrash.disabled = false;
                        this.$refs.btnTrashMob.disabled = false;
                        this.$refs.btnSave.disabled = false;
                        this.$refs.btnSaveMob.disabled = false;
                    });
            },
            fetchResponse: function(response) {
                if(response.error){
                    alert(response.error_text);
                    this.$refs.btnTrash.disabled = false;
                    this.$refs.btnTrashMob.disabled = false;
                    this.$refs.btnSave.disabled = false;
                    this.$refs.btnSaveMob.disabled = false;
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
                formData.append('description', this.description);
                formData.append('preview', this.files[this.activeIndex]);
                return formData;
            }

        },
        watch: {
            'username' : ['changeError'],
            'password' : ['changeError'],
            'password_confirm' : ['changeError'],
        }

    }
</script>
