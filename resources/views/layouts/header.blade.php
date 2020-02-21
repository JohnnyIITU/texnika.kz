<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="/">ADMIN</a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09"
            aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExample09" style="">
        <ul class="navbar-nav mr-auto">
            <a class="nav-link" href="{{route('users')}}">Пользователи</a>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Справочники</a>
                <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="{{route('cities')}}">Города</a>
                    <a class="dropdown-item" href="{{route('equipments')}}">Тип техники</a>
                    <a class="dropdown-item" href="{{route('service_types')}}">Тип услуг</a>
                    <a class="dropdown-item" href="{{route('marks')}}">Марки</a>
                </div>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Объявления</a>
                <div class="dropdown-menu" aria-labelledby="dropdown08">
                    <a class="dropdown-item" href="{{route('rents')}}">Аренда</a>
                    <a class="dropdown-item" href="{{route('sales')}}">Продажа</a>
                    <a class="dropdown-item" href="{{route('services')}}">Услуги</a>
                </div>
            </li>
        </ul>

        <form class="form-inline my-2 my-md-0">
            <a href="/logout" class="logout">Выйти</a>
        </form>
    </div>
</nav>
