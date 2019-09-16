<template>
    <main class="main-content" role="main">
        <div class="container">
            <section class="mb-5">
                <div class="filter-first">
                    <div class="row ml-0 mr-0 align-items-stretch">
                        <div class="col-lg-4 pl-0 pr-0 position-static">
                            <div class="dropdown position-static h-100">
                                <a href="#" class="filter-button" role="button" id="dropdownRegionLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добавить фильтр по <span>{{cityLabel}}</span></a>
                                <div class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownRegionLink">
                                    <ul class="filter-list filter-list--column-5">
                                        <li class="filter-list__item" :class="item.class" @click="changeCityKey(item.key)" v-for="item in cityOptions" :key="item.key"><a href="#">{{item.label}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 pl-0 pr-0 position-static">
                            <div class="dropdown position-static h-100">
                                <a href="#" class="filter-button" role="button" id="dropdownBrandLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добавить фильтр по <span>{{typeLabel}}</span></a>
                                <div class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownBrandLink">
                                    <ul class="filter-list filter-list--column-5">
                                        <li class="filter-list__item" :class="item.class" @click="changeTypeKey(item.key)" v-for="item in typeOptions"><a href="#">{{item.label}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 pl-0 pr-0 position-static">
                            <div class="dropdown position-static h-100">
                                <a href="#" class="filter-button" role="button" id="dropdownTypeLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добавить фильтр по <span>{{markLabel}}</span></a>
                                <div class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownTypeLink">
                                    <ul class="filter-list filter-list--column-4">
                                        <li class="filter-list__item" :class="item.class" v-for="item in markOptions" @click="changeMarkKey(item.key)"><a href="#">{{item.label}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-second">
                    <div class="row">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <input type="text" class="form-control form-control-sm" placeholder="Поиск по ключевым словам">
                        </div>
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="input-group">
                                <div class="input-group-prepend col-lg-6 col-md-4 pr-0 pl-0">
                                    <span class="input-group-text w-100">Цена</span>
                                </div>
                                <input type="text" aria-label="First name" class="form-control form-control-sm" placeholder="От">
                                <input type="text" aria-label="Last name" class="form-control form-control-sm" placeholder="До">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-warning btn-block btn-sm">Поиск</button>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <h1 class="title-page">Найдено {{count}} объявления</h1>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col -->
                    <div class="col-lg-4 mb-5" v-for="(item, index) in objectList">
                        <div class="item">
                            <h4 class="item__title"><a href="#">{{item.title}}</a></h4>
                            <div class="item__image"  :style="{ backgroundImage: 'url(\'' + item.image_data + '\')' }">
                                <i class="item__star current"></i>
                                <div class="item__price-first">{{item.price}}</div>
                                <div class="item__content">
                                    <span class="item__info">Вы звонили</span>
                                    <div class="item__price">{{item.price}}</div>
                                    <div class="item__excerpt">{{item.description.substring(0,150)}}</div>
                                    <div class="item__meta">{{item.city}}, {{item.date}}</div>
                                </div>
                            </div>
                            <a href="#" class="item__overlay-link">Заголовок второго уровня</a>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <a href="#" class="btn btn-secondary btn-block btn-lg mt-5"><img src="images/close.png" alt="close"></a>
            </section>
        </div>
    </main>
</template>

<script>
    export default {
        name: "rent-search",
        data() {
            return {
                objectList: [],
                lastIndex: 0,
                city: 1,
                type: 1,
                mark: 1,
                priceFrom: 0,
                priceTo: 0,
                keyWords: '',
                searchData: {},
                cityOptions: [],
                markOptions: [],
                typeOptions: [],
                count : 0,
                cityLabel: 'Местоположение',
                markLabel: 'Марка техники',
                typeLabel: 'Тип техники'
            }
        },
        mounted: function () {
            this.getCityOptions();
            this.getTypeOptions();
            this.getMarkOptions();
            this.search();
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
            changeCityKey: function (key) {
                this.city = key;
                var label = '';
                this.cityOptions.forEach(function(option){
                    if(option.key === key){
                        option.class = 'current';
                        label = option.label;
                    }else{
                        option.class = '';
                    }
                });
                this.cityLabel = label;
            },
            changeMarkKey: function (key) {
                this.mark = key;
                var label = '';
                this.markOptions.forEach(function(option){
                    if(option.key === key){
                        option.class = 'current';
                        label = option.label;
                    }else{
                        option.class = '';
                    }
                });
                this.markLabel = label;
            },
            changeTypeKey: function (key) {
                this.type = key;
                var label = '';
                this.typeOptions.forEach(function(option){
                    if(option.key === key){
                        option.class = 'current';
                        label = option.label;
                    }else{
                        option.class = '';
                    }
                });
                this.typeLabel = label;
            },
            resetKeys: function(){
                this.lastIndex = 0;
                this.searchData = {
                    mark : this.mark,
                    city : this.city,
                    type : this.type,
                    lastIndex : this.lastIndex,
                    priceFrom : this.priceFrom,
                    priceTo : this.priceTo,
                    keyWords : this.keyWords,
                }
            },
            search: function(){
                this.axios.post('/rent/getObjects', this.searchData).then(response => {
                    this.fetchResponseData(response.data);
                });
            },
            fetchResponseData: function (response) {
                if(this.lastIndex === 0){
                    this.objectList = response.data;
                }else{
                    this.objectList.push(response.data);
                }
                this.lastIndex = response.lastIndex;
                this.count = response.count;
            }
        },
        watch: {
            city : this.resetKeys(),
            type : this.resetKeys(),
            mark : this.resetKeys(),
            priceFrom : this.resetKeys(),
            priceTo : this.resetKeys(),
            keyWords : this.resetKeys(),
        }
    }
</script>

<style scoped>

</style>