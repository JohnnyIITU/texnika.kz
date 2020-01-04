<template>
    <main class="main-content" role="main">
        <div class="container">
            <section class="mb-5">
                <div class="filter-first">
                    <div class="row ml-0 mr-0 align-items-stretch">
                        <div class="col-lg-3 pl-0 pr-0 position-static">
                            <div class="dropdown position-static h-100">
                                <a href="#" class="filter-button" role="button" id="dropdownRegionLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Местоположение<span>{{cityLabel}}</span></a>
                                <div class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownRegionLink">
                                    <ul class="filter-list filter-list--column-5">
                                        <li class="filter-list__item" :class="item.class" @click="changeCityKey(item.key)" v-for="item in cityOptions" :key="item.key"><a href="#">{{item.label}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 pl-0 pr-0 position-static">
                            <div class="dropdown position-static h-100">
                                <a href="#" class="filter-button" role="button" id="dropdownBrandLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Тип техники<span>{{typeLabel}}</span></a>
                                <div class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownBrandLink">
                                    <ul class="filter-list filter-list--column-5">
                                        <li class="filter-list__item" :class="item.class" @click="changeTypeKey(item.key)" v-for="item in typeOptions"><a href="#">{{item.label}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 pl-0 pr-0 position-static">
                            <div class="dropdown position-static h-100">
                                <a href="#" class="filter-button" role="button" id="dropdownTypeLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Марка<span>{{markLabel}}</span></a>
                                <div class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownTypeLink">
                                    <ul class="filter-list filter-list--column-4">
                                        <li class="filter-list__item" :class="item.class" v-for="item in markOptions" @click="changeMarkKey(item.key)"><a href="#">{{item.label}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 pl-0 pr-0 position-static">
                            <div class="dropdown h-100">
                                <a href="#" class="filter-button" role="button" id="dropdownStatusLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Состояние<span>{{conditionLabel}}</span></a>
                                <div class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownStatusLink">
                                    <ul class="filter-list">
                                        <li class="filter-list__item" :class="item.class" v-for="item in conditionOptions" @click="changeConditionKey(item.key)"><a href="#">{{item.label}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-second">
                    <div class="row">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <input type="text" class="form-control form-control-sm" v-model="keyWords" placeholder="Поиск по ключевым словам">
                        </div>
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="input-group">
                                <div class="input-group-prepend col-lg-6 col-md-4 pr-0 pl-0">
                                    <span class="input-group-text w-100">Цена</span>
                                </div>
                                <input type="text" aria-label="First name" class="form-control form-control-sm" v-model="priceFrom" placeholder="От">
                                <input type="text" aria-label="Last name" class="form-control form-control-sm" v-model="priceTo" placeholder="До">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" @click="searchWithReset" class="btn btn-warning btn-block btn-sm">Поиск</button>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <h1 class="title-page">Найдено {{count}} {{text}}</h1>
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
                                    <!--<span class="item__info">Вы звонили</span>-->
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
                <a @click="loadMore()" v-if="!allPostShown" class="btn btn-secondary btn-block btn-lg mt-5"><img src="images/close.png" alt="close"></a>
            </section>
        </div>
    </main>
</template>

<script>
    export default {
        name: "sale-search",
        data() {
            return {
                objectList: [],
                lastIndex: 0,
                city: null,
                type: null,
                mark: null,
                priceFrom: null,
                priceTo: null,
                keyWords: null,
                searchData: {},
                cityOptions: [],
                markOptions: [],
                typeOptions: [],
                conditionOptions: [],
                text: 'Объявлении',
                count : 0,
                cityLabel: 'Не выбрано',
                markLabel: 'Не выбрано',
                typeLabel: 'Не выбрано',
                conditionLabel: "Не выбрано",
                bottomOfWindow: 0,
                allPostShown: false,
                objectIds: [],
            }
        },
        mounted: function () {
            this.getCityOptions();
            this.getTypeOptions();
            this.getMarkOptions();
            this.getConditionOptions();
            this.search();
        },
        methods: {
            getCityOptions: function () {
                this.axios.post('/getCityList', {}).then((response) => {
                    this.cityOptions = response.data;
                    this.cityOptions.unshift({
                        class : "current",
                        key : 0,
                        label : "Не выбрано"
                    })
                });
            },
            getTypeOptions: function () {
                this.axios.post('/getTypeList', {}).then((response) => {
                    this.typeOptions = response.data;
                    this.typeOptions.unshift({
                        class : "current",
                        key : 0,
                        label : "Не выбрано"
                    })
                });
            },
            getMarkOptions: function () {
                this.axios.post('/getMarkList', {}).then((response) => {
                    this.markOptions = response.data;
                    this.markOptions.unshift({
                        class : "current",
                        key : 0,
                        label : "Не выбрано"
                    })
                });
            },
            getConditionOptions: function () {
                this.axios.post('/sale/getConditionOptions', {}).then(response => {
                    this.conditionOptions = response.data;
                    this.conditionOptions.unshift({
                        class : "current",
                        key : 0,
                        label : "Не выбрано"
                    })
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
            changeConditionKey: function (key) {
                this.type = key;
                var label = '';
                this.conditionOptions.forEach(function(option){
                    if(option.key === key){
                        option.class = 'current';
                        label = option.label;
                    }else{
                        option.class = '';
                    }
                });
                this.conditionLabel = label;
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
                this.objectList = [];
                this.objectIds = [];
            },
            search: function(){
                this.resetKeys();
                this.axios.post('/sale/getObjects', this.searchData).then(response => {
                    this.fetchResponseData(response.data, true);
                });
            },
            fetchResponseData: function (response, clearData = false) {
                this.lastIndex = response.last_index;
                var vm = this;
                if(typeof response.data !== "undefined"){
                    if(response.data.length < 9) {
                        this.allPostShown = true;
                    }
                    response.data.forEach( function (item) {
                        if(!vm.objectIds.includes(item.id)){
                            vm.objectIds.push(item.id);
                            vm.objectList.push(item);
                        }
                    });
                }
                this.count = response.count;
                this.searchData.lastindex = this.lastIndex;
            },
            changeText: function(){
                if(this.count === 1){
                    this.text = 'Обявление';
                }else if(this.count < 5 && this.count > 1){
                    this.text = 'Обявления';
                }else{
                    this.text = 'Обявлении';
                }
            },
            loadMore: function(){
                this.axios.post('/sale/getObjects', this.searchData).then(response => {
                    this.fetchResponseData(response.data);
                });
            },
            handleScroll () {
                this.bottomOfWindow = (parseInt(document.documentElement.scrollTop) + parseInt(window.innerHeight) + 1  ) === document.documentElement.scrollHeight;
                if (this.bottomOfWindow) {
                    this.loadMore()
                }
            },
            searchWithReset() {
                this.resetKeys()
                this.search()
            }
        },
        watch: {
            count: 'changeText'
        },
        beforeMount () {
            window.addEventListener('scroll', this.handleScroll);
        },

        beforeDestroy () {
            window.removeEventListener('scroll', this.handleScroll);
        }
    }
</script>

<style scoped>

</style>
