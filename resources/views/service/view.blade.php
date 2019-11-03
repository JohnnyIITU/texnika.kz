@extends('layouts.main')
@php
    use App\City;
    use App\Equipment;
    use App\ServiceType;
@endphp
@section('content')
    <main class="main-content" role="main">
        <div class="container">
            <service-view
                    :image_urls="{{ json_encode($imageUrl) }}"
                    :mark_model="{{ json_encode($info->getMarkAndModelLabel())}}"
                    :price="{{  json_encode(number_format($info->price, 0 , '', ' ')) }}"
                    :city="{{ json_encode(City::getCityById($info->city))}}"
                    :type="{{ json_encode(Equipment::getLabelById($info->type)) }}"
                    :description="{{json_encode($info->description)}}"
                    :phone="{{json_encode($info->phone)}}"
                    :email="{{json_encode($info->email)}}"
                    :service="{{json_encode(ServiceType::getLabelById($info->service))}}"
            ></service-view>

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