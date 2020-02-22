<?php
use App\Sale;
use App\Rent;
use App\Service;
?>
@extends('layouts.main')

@section('content')
    <title>
        Главная | texnika.kz
    </title>
    <meta name="description" content="Покупка, Аренда спецтехники">
<main class="main-content" role="main">
    <div class="container">
        <div class="row">
            <!-- begin col -->
            <div class="col-xl-4 mb-5">
                <h3 class="title"><a href="#">Продажа техники</a></h3>
                <!-- begin hot -->
                <div class="hot">
                    <div class="row">
                        @foreach(Sale::getActiveAndNewOrders() as $order)
                        <div class="col-xl-12 col-md-4 mb-4">
                            <div class="hot-item" style="background-image:url({{$order['image_data']}})">
                                <i class="hot-item__star current"></i>
                                <div class="hot-item__content">
                                    <h4 class="hot-item__title"><a href="#">{{$order['title']}}</a></h4>
                                    <div class="hot-item__footer">
                                        <div class="hot-item__meta"><span class="hot-item__price">{{$order['price']}}</span> {{$order['city']}}, {{$order['date']}}</div>
                                        <a href="#" class="btn btn-warning btn-sm">Подробнее</a>
                                    </div>
                                </div>
                                <a href="{{"/sale/view/{$order['id']}"}}" class="hot-item__overlay-link">Заголовок может быть в одну или две строки</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="/sale" class="btn btn-warning btn-block">Расширенный поиск</a>
                    <a href="/sale/create" class="btn btn-light btn-block mt-4">Подать объявление в этот раздел</a>
                </div>
                <!-- end hot -->
            </div>
            <!-- end col -->
            <!-- begin col -->
            <div class="col-xl-4 mb-5">
                <h3 class="title"><a href="#">Аренда техники</a></h3>
                <!-- begin hot -->
                <div class="hot">
                    <div class="row">
                        @foreach(Rent::getActiveAndNewOrders() as $order)
                            <div class="col-xl-12 col-md-4 mb-4">
                                <div class="hot-item" style="background-image:url({{$order['image_data']}})">
                                    <i class="hot-item__star current"></i>
                                    <div class="hot-item__content">
                                        <h4 class="hot-item__title"><a href="#">{{$order['title']}}</a></h4>
                                        <div class="hot-item__footer">
                                            <div class="hot-item__meta"><span class="hot-item__price">{{$order['price']}}</span> {{$order['city']}}, {{$order['date']}}</div>
                                            <a href="#" class="btn btn-warning btn-sm">Подробнее</a>
                                        </div>
                                    </div>
                                    <a href="{{"/rent/view/{$order['id']}"}}" class="hot-item__overlay-link">Заголовок может быть в одну или две строки</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="/rent" class="btn btn-warning btn-block">Расширенный поиск</a>
                    <a href="/rent/create" class="btn btn-light btn-block mt-4">Подать объявление в этот раздел</a>
                </div>
                <!-- end hot -->
            </div>
            <!-- end col -->
            <!-- begin col -->
            <div class="col-xl-4 mb-5">
                <h3 class="title"><a href="#">Обслуживание техники</a></h3>
                <!-- begin hot -->
                <div class="hot">
                    <div class="row">
                        @foreach(Service::getActiveAndNewOrders() as $order)
                            <div class="col-xl-12 col-md-4 mb-4">
                                <div class="hot-item" style="background-image:url({{$order['image_data']}})">
                                    <i class="hot-item__star current"></i>
                                    <div class="hot-item__content">
                                        <h4 class="hot-item__title"><a href="#">{{$order['title']}}</a></h4>
                                        <div class="hot-item__footer">
                                            <div class="hot-item__meta"><span class="hot-item__price">{{$order['price']}}</span> {{$order['city']}}, {{$order['date']}}</div>
                                            <a href="#" class="btn btn-warning btn-sm">Подробнее</a>
                                        </div>
                                    </div>
                                    <a href="{{"/service/view/{$order['id']}"}}" class="hot-item__overlay-link">Заголовок может быть в одну или две строки</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="/service" class="btn btn-warning btn-block">Расширенный поиск</a>
                    <a href="/service/create" class="btn btn-light btn-block mt-4">Подать объявление в этот раздел</a>
                </div>
                <!-- end hot -->
            </div>
            <!-- end col -->
        </div>
    </div>
</main>
@endsection