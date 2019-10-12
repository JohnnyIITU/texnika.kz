@extends('layouts.main')

@section('content')
    <main class="main-content" role="main">
        <div class="container">
            <section class="mb-5">
                <!-- begin row -->
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Mercedes-Benz 710</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col col-lg-6 text-lg-right">
                        <a href="#" class="">Добавить в избранное <i class="icon icon--star-small"></i></a>
                    </div>
                </div>
                <!-- end row -->
                <!-- begin row -->
                {{--<div class="row d-xl-none d-lg-none d-md-none mb-5">--}}
                    {{--<div class="col">--}}
                        {{--<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">--}}
                            {{--<div class="carousel-inner">--}}
                                {{--<div class="carousel-item active">--}}
                                    {{--<img src="images/temp/hot-item-preview1.jpg" class="d-block w-100" alt="...">--}}
                                {{--</div>--}}
                                {{--<div class="carousel-item">--}}
                                    {{--<img src="images/temp/hot-item-preview1.jpg" class="d-block w-100" alt="...">--}}
                                {{--</div>--}}
                                {{--<div class="carousel-item">--}}
                                    {{--<img src="images/temp/hot-item-preview1.jpg" class="d-block w-100" alt="...">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">--}}
                                {{--<span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                                {{--<span class="sr-only">Previous</span>--}}
                            {{--</a>--}}
                            {{--<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">--}}
                                {{--<span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                                {{--<span class="sr-only">Next</span>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <!-- end row -->
                <!-- begin row -->
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-3 d-none d-md-block">
                        <ul class="thumbnail-list">
                            @foreach($imageUrl as $url)
                            <li class="thumbnail-item">
                                <a href="{{$url}}" data-image-role="trigger" data-image-url="{{$url}}" style="background-image:url('{{$url}}')"></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-xl-6 col-lg-10 col-md-9 mb-5 d-none d-md-block">
                        <div class="detail-image-frame" data-image-role="target" class="detail-image" style="background-image:url('{{$imageUrl[0]}}')">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <!-- begin description-->
                        <div class="description">
                            <div class="row mb-4">
                                <div class="col-lg-6 mb-2 mb-lg-0">
                                    <span class="description__status">Аренда</span>
                                </div>
                                <div class="col-lg-6 text-lg-right">
                                    <span class="description__call">Вы не звонили</span>
                                </div>
                            </div>
                            <h1 class="description__title">{{$info->getMarkAndModelLabel()}}</h1>
                            <p class="description__price">{{number_format($info->price, 0 , '', ' ')}} &#8376;</p>
                            <ul class="description__list mb-5">
                                <li><span>Город:</span> Алматы</li>
                                <li><span>Тип:</span> Грузовик</li>
                                <li><span>Топливо:</span> Дизель</li>
                            </ul>
                            <ul class="nav nav-tabs" id="descriptionTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc" role="tab" aria-controls="home" aria-selected="true">Описание</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Детали</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Контакты</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="descriptionTabContent">
                                <div class="tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</div>
                                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</div>
                            </div>
                        </div>
                        <!-- end description-->
                    </div>
                </div>
                <!-- end row -->
            </section>
            {{--<section>--}}
                {{--<h2 class="mb-5">Похожие объявления</h2>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg-4 mb-5">--}}
                        {{--<div class="item">--}}
                            {{--<h4 class="item__title"><a href="#">Заголовок второго уровня</a></h4>--}}
                            {{--<div class="item__image" style="background-image:url('images/temp/hot-item-preview1.jpg');">--}}
                                {{--<i class="item__star current"></i>--}}
                                {{--<div class="item__price-first">17 500 500 &#8376;</div>--}}
                                {{--<div class="item__content">--}}
                                    {{--<span class="item__info">Вы звонили</span>--}}
                                    {{--<div class="item__price">17 500 500 &#8376;</div>--}}
                                    {{--<div class="item__excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspend</div>--}}
                                    {{--<div class="item__meta">Алматы, 2 дня назад</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<a href="#" class="item__overlay-link">Заголовок второго уровня</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-4 mb-5">--}}
                        {{--<div class="item">--}}
                            {{--<h4 class="item__title"><a href="#">Заголовок второго уровня</a></h4>--}}
                            {{--<div class="item__image" style="background-image:url('images/temp/hot-item-preview1.jpg');">--}}
                                {{--<i class="item__star"></i>--}}
                                {{--<div class="item__price-first">17 500 500 &#8376;</div>--}}
                                {{--<div class="item__content">--}}
                                    {{--<span class="item__info">Вы звонили</span>--}}
                                    {{--<div class="item__price">17 500 500 &#8376;</div>--}}
                                    {{--<div class="item__excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspend</div>--}}
                                    {{--<div class="item__meta">Алматы, 2 дня назад</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<a href="#" class="item__overlay-link">Заголовок второго уровня</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-4 mb-5">--}}
                        {{--<div class="item">--}}
                            {{--<h4 class="item__title"><a href="#">Заголовок второго уровня</a></h4>--}}
                            {{--<div class="item__image" style="background-image:url('images/temp/hot-item-preview1.jpg');">--}}
                                {{--<i class="item__star"></i>--}}
                                {{--<div class="item__price-first">17 500 500 &#8376;</div>--}}
                                {{--<div class="item__content">--}}
                                    {{--<span class="item__info">Вы звонили</span>--}}
                                    {{--<div class="item__price">17 500 500 &#8376;</div>--}}
                                    {{--<div class="item__excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspend</div>--}}
                                    {{--<div class="item__meta">Алматы, 2 дня назад</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<a href="#" class="item__overlay-link">Заголовок второго уровня</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</section>--}}
        </div>
    </main>
@endsection