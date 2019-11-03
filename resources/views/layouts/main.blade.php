<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Главная</title>
        <link rel="stylesheet" href="{{asset('styles/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('styles/main.min.css')}}">
    </head>
    <body>
        <div id="app">
            <!-- begin main-header -->
            <header class="main-header" role="banner">
                <!-- begin top-header -->
                <div class="top-header">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <ul class="top-header-list">
                                    {{--<li class="top-header-list__item">--}}
                                        {{--<a class="top-header-list__link top-header-list__link--region collapsed"--}}
                                           {{--data-toggle="collapse" href="#collapseRegion" role="button" aria-expanded="false"--}}
                                           {{--aria-controls="collapseRegion">Алматы</a>--}}
                                    {{--</li>--}}
                                    <li class="top-header-list__item">
                                        <a href="mailto:support@texnika.kz" class="top-header-list__link">support@texnika.kz</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="top-header-nav">
                                    @guest
                                        <register></register>
                                        <login></login>
                                    @else
                                        <li class="top-header-nav__item">
                                            <div class="dropdown">
                                                <a href="/logout" role="button" id="dropdownLoginLink" class="top-header-nav__link"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Выход
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                    {{--<li class="top-header-nav__item top-header-nav__item--scrollpanel">--}}
                                            {{--<div class="dropdown">--}}
                                                {{--<a href="#" role="button"--}}
                                                   {{--class="top-header-nav__link top-header-nav__link--favorite"--}}
                                                   {{--id="dropdownFavoritesLink" data-toggle="dropdown" aria-haspopup="true"--}}
                                                   {{--aria-expanded="false">--}}
                                                    {{--Избранное--}}
                                                {{--</a>--}}
                                                {{--<div class="dropdown-menu" aria-labelledby="dropdownFavoritesLink">--}}
                                                    {{--<h3 class="mb-4">Избранное</h3>--}}
                                                    {{--<!-- begin scrollpanel -->--}}
                                                    {{--<div class="scrollpanel">--}}
                                                        {{--<!-- begin favorites -->--}}
                                                        {{--<div class="favorites">--}}
                                                            {{--<ul class="favorites__list favorites__list--header">--}}
                                                                {{--<li class="favorites__item item-favorites">--}}
                                                                    {{--<div class="item-favorites__inner">--}}
                                                                        {{--<h4 class="item-favorites__title"><a href="#">Заголовок--}}
                                                                                {{--может быть в одну или две строки</a></h4>--}}
                                                                        {{--<div class="item-favorites__image"--}}
                                                                             {{--style="background-image: url('../images/temp/photo-favorites1.jpg');"></div>--}}
                                                                        {{--<span class="item-favorites__price">17 500 000 &#8376;</span>--}}
                                                                        {{--<a href="#" class="item-favorites__overlay-link">Заголовок--}}
                                                                            {{--может быть в одну или две строки</a>--}}
                                                                    {{--</div>--}}
                                                                {{--</li>--}}
                                                                {{--<li class="favorites__item item-favorites">--}}
                                                                    {{--<div class="item-favorites__inner">--}}
                                                                        {{--<h4 class="item-favorites__title"><a href="#">Заголовок</a>--}}
                                                                        {{--</h4>--}}
                                                                        {{--<div class="item-favorites__image"--}}
                                                                             {{--style="background-image: url('/images/temp/photo-favorites2.jpg');"></div>--}}
                                                                        {{--<span class="item-favorites__price">17 500 000 &#8376;</span>--}}
                                                                        {{--<a href="#"--}}
                                                                           {{--class="item-favorites__overlay-link">Заголовок</a>--}}
                                                                    {{--</div>--}}
                                                                {{--</li>--}}
                                                                {{--<li class="favorites__item item-favorites">--}}
                                                                    {{--<div class="item-favorites__inner">--}}
                                                                        {{--<h4 class="item-favorites__title"><a href="#">Заголовок--}}
                                                                                {{--может быть в одну или две строки</a></h4>--}}
                                                                        {{--<div class="item-favorites__image"--}}
                                                                             {{--style="background-image: url('../images/temp/photo-favorites1.jpg');"></div>--}}
                                                                        {{--<span class="item-favorites__price">17 500 000 &#8376;</span>--}}
                                                                        {{--<a href="#" class="item-favorites__overlay-link">Заголовок--}}
                                                                            {{--может быть в одну или две строки</a>--}}
                                                                    {{--</div>--}}
                                                                {{--</li>--}}
                                                                {{--<li class="favorites__item item-favorites">--}}
                                                                    {{--<div class="item-favorites__inner">--}}
                                                                        {{--<h4 class="item-favorites__title"><a href="#">Заголовок</a>--}}
                                                                        {{--</h4>--}}
                                                                        {{--<div class="item-favorites__image"--}}
                                                                             {{--style="background-image: url('../images/temp/photo-favorites2.jpg');"></div>--}}
                                                                        {{--<span class="item-favorites__price">17 500 000 &#8376;</span>--}}
                                                                        {{--<a href="#"--}}
                                                                           {{--class="item-favorites__overlay-link">Заголовок</a>--}}
                                                                    {{--</div>--}}
                                                                {{--</li>--}}
                                                                {{--<li class="favorites__item item-favorites">--}}
                                                                    {{--<div class="item-favorites__inner">--}}
                                                                        {{--<h4 class="item-favorites__title"><a href="#">Заголовок--}}
                                                                                {{--может быть в одну или две строки</a></h4>--}}
                                                                        {{--<div class="item-favorites__image"--}}
                                                                             {{--style="background-image: url('../images/temp/photo-favorites1.jpg');"></div>--}}
                                                                        {{--<span class="item-favorites__price">17 500 000 &#8376;</span>--}}
                                                                        {{--<a href="#" class="item-favorites__overlay-link">Заголовок--}}
                                                                            {{--может быть в одну или две строки</a>--}}
                                                                    {{--</div>--}}
                                                                {{--</li>--}}
                                                                {{--<li class="favorites__item item-favorites">--}}
                                                                    {{--<div class="item-favorites__inner">--}}
                                                                        {{--<h4 class="item-favorites__title"><a href="#">Заголовок</a>--}}
                                                                        {{--</h4>--}}
                                                                        {{--<div class="item-favorites__image"--}}
                                                                             {{--style="background-image: url('../images/temp/photo-favorites2.jpg');"></div>--}}
                                                                        {{--<span class="item-favorites__price">17 500 000 &#8376;</span>--}}
                                                                        {{--<a href="#"--}}
                                                                           {{--class="item-favorites__overlay-link">Заголовок</a>--}}
                                                                    {{--</div>--}}
                                                                {{--</li>--}}
                                                            {{--</ul>--}}
                                                        {{--</div>--}}
                                                        {{--<!-- end favorites -->--}}
                                                    {{--</div>--}}
                                                    {{--<!-- end scrollpanel -->--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end top-header -->
                <!-- begin collapse -->
                <div class="region-collapse collapse" id="collapseRegion">
                    <div class="card card-body">
                        <div class="container">
                            <h4 class="region-title">Выберите регион</h4>
                            <ul class="region-list">
                                <li class="region-list__item current"><a href="#">Алматы</a></li>
                                <li class="region-list__item"><a href="#">Нур-Султан</a></li>
                                <li class="region-list__item"><a href="#">Актау</a></li>
                                <li class="region-list__item"><a href="#">Актобе</a></li>
                                <li class="region-list__item"><a href="#">Атырау</a></li>
                                <li class="region-list__item"><a href="#">Жезказган</a></li>
                                <li class="region-list__item"><a href="#">Караганда</a></li>
                                <li class="region-list__item"><a href="#">Кокшетау</a></li>
                                <li class="region-list__item"><a href="#">Костанай</a></li>
                                <li class="region-list__item"><a href="#">Кульсары</a></li>
                                <li class="region-list__item"><a href="#">Кызылорда</a></li>
                                <li class="region-list__item"><a href="#">Павлодар</a></li>
                                <li class="region-list__item"><a href="#">Петропавловск</a></li>
                                <li class="region-list__item"><a href="#">Риддер</a></li>
                                <li class="region-list__item"><a href="#">Рудный</a></li>
                                <li class="region-list__item"><a href="#">Семей</a></li>
                                <li class="region-list__item"><a href="#">Талдыкорган</a></li>
                                <li class="region-list__item"><a href="#">Тараз</a></li>
                                <li class="region-list__item"><a href="#">Уральск</a></li>
                                <li class="region-list__item"><a href="#">Усть-Каменогорск</a></li>
                                <li class="region-list__item"><a href="#">Шымкент</a></li>
                                <li class="region-list__item"><a href="#">Экибастуз</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end collapse -->
                <!-- begin container -->
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/"><img src="{{asset('images/logo.png')}}" alt="texnika.kz"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ml-auto align-items-lg-center">
                                <li class="nav-item active"><a class="nav-link" href="/">Главная</a></li>
                                <li class="nav-item"><a class="nav-link" href="/sale">Продажа</a></li>
                                <li class="nav-item"><a class="nav-link" href="/rent">Аренда</a></li>
                                <li class="nav-item"><a class="nav-link" href="/service">Обслуживание</a></li>
                                <li class="nav-item">
                                    <div class="dropdown ml-lg-4">
                                        <a href="#" role="button" id="dropdownMenuButton"
                                           class="btn btn-warning btn-sm btn-caret mt-3 mt-lg-0 btn-block"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Подать объявление
                                        </a>
                                        <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="/sale/create">Продажа</a>
                                            <a class="dropdown-item" href="/rent/create">Аренда</a>
                                            <a class="dropdown-item" href="/services/create">Обслуживание</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- end container -->
            </header>
            <!-- end main-header -->

            <!-- begin main-content -->
            @yield('content')
            <!-- end main-content -->


            <!-- begin main-footer -->
            <footer class="main-footer" role="contentinfo">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <p class="footer-copyright">&copy; 2019 Texnika</p>
                            <a href="#" class="footer-link">Контакты</a>
                        </div>
                        <div class="col-lg-7">
                            <ul class="footer-social">
                                <li class="footer-social__item"><a href="#" class="footer-link">Telegram</a></li>
                                <li class="footer-social__item"><a href="#" class="footer-link">Facebook</a></li>
                                <li class="footer-social__item"><a href="#" class="footer-link">Instagram</a></li>
                                <li class="footer-social__item"><a href="#" class="footer-link">Vkontakte</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end main-footer -->
        </div>
        <!-- begin js -->
        <script src="{{asset('js/main.min.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery(".scrollpanel").scrollpanel();
            });
        </script>
        {{--end js--}}
</body>
</html>
