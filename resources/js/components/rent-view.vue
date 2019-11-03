<template>
    <section class="mb-5">
        <!-- begin row -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{mark_model}}</li>
                    </ol>
                </nav>
            </div>
            <!--<div class="col col-lg-6 text-lg-right">-->
                <!--<a href="#" class="">Добавить в избранное <i class="icon icon&#45;&#45;star-small"></i></a>-->
            <!--</div>-->
        </div>
        <!-- end row -->
        <!-- begin row -->
        <div class="row d-xl-none d-lg-none d-md-none mb-5">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item" v-for="url in image_urls" :class="{active : url === currentImage}">
                            <img :src="url" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- begin row -->
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-3 d-none d-md-block">
                <ul class="thumbnail-list">
                    <li class="thumbnail-item" v-for="url in image_urls">
                        <a data-image-role="trigger" :class="{'thumbnail-current' : url === currentImage}" @click="setImage" :data-image-url="url"  :style="{ backgroundImage: 'url(' + url + ')' }"></a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-6 col-lg-10 col-md-9 mb-5 d-none d-md-block">
                <div class="detail-image-frame" data-image-role="target" :style="{ backgroundImage: 'url(' + currentImage + ')' }">
                </div>
            </div>
            <div class="col-xl-4 col-lg-12">
                <!-- begin description-->
                <div class="description">
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-2 mb-lg-0">
                            <span class="description__status">Аренда</span>
                        </div>
                        <!--<div class="col-lg-6 text-lg-right">-->
                            <!--<span class="description__call">Вы не звонили</span>-->
                        <!--</div>-->
                    </div>
                    <h1 class="description__title">{{mark_model}}</h1>
                    <p class="description__price">{{price}} &#8376;</p>
                    <ul class="description__list mb-5">
                        <li><span>Город :</span> {{city}}</li>
                        <li><span>Тип :</span> {{type}}</li>
                    </ul>
                    <ul class="nav nav-tabs" id="descriptionTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc" role="tab" aria-controls="home" aria-selected="true">Описание</a>
                        </li>
                        <!--<li class="nav-item">-->
                            <!--<a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Детали</a>-->
                        <!--</li>-->
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Контакты</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="descriptionTabContent">
                        <div class="tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                            {{description}}
                        </div>
                        <!--<div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab"></div>-->
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div v-if="phone !== null">Телефон : {{phone}}</div>
                            <div v-if="email !== null">Эл.почта : {{email}}</div>
                        </div>
                    </div>
                </div>
                <!-- end description-->
            </div>
        </div>
        <!-- end row -->
    </section>
</template>

<script>
    export default {
        name: "rent-view",
        data() {
            return {
                currentImage: null
            }
        },
        props: {
            image_urls : Array,
            mark_model : String,
            price : String,
            city : String,
            type : String,
            description : String,
            phone : String,
            email : String,
            // isGuest: Boolean,
            // favourites: Object,
            // userCity: Object,
        },
        mounted: function(){
            this.currentImage = this.image_urls[0] || null
        },
        methods: {
            setImage(e) {
                var elem = e.path[0];
                var url = elem.getAttribute('data-image-url');
                this.currentImage = url;
            }
        },


    }
</script>
