<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Главная')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/mainStyle.css') }}">
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('main') }}">Главная</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if (auth()->check() && auth()->user()->role == 'seller')
                    <li class="nav-item dropdown {{ Request::is('CPp/*') || Request::is('products/create') ? 'current-menu-item' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Панель управления
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animate__animated animate__fadeIn"
                             aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('CPp/*') ? 'current-menu-item' : '' }}" href="{{ route('CPp.index') }}">Мои товары</a>
                            <a class="dropdown-item {{ Request::is('CPp/*') ? 'current-menu-item' : '' }}" href="{{ route('CPp.create') }}">Добавить товар</a>
                        </div>
                    </li>
                @endif
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <a class="nav-link" href="{{ route('admin.index') }}">Панель администрирования</a>
                    @endif
            </ul>

            <a style="margin-right: 20px;" href="{{ route('cart.show') }}">
                <img src="{{ asset('images/cart.png') }}" alt="Корзина" class="cart-icon">
            </a>
            <form class="form-inline my-2 my-lg-0 mr-3" action="#" method="get">
                <input class="form-control mr-sm-2" type="text" name="query" placeholder="Поиск" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Найти</button>
            </form>
            <div id="cart-notification" class="cart-notification"></div>

            <div class="auth">
                @if(!Auth::check())
                    <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                @else
                    <a class="nav-link user-profile-link" href="{{route('profile')}}"
                       data-name="{{ Auth::user()->first_name }}">Приветствуем, {{ Auth::user()->first_name }}!</a>
                    <a class="nav-link" href="{{ route('logout') }}">
                        Выход
                    </a>
                @endif
            </div>
        </div>
    </nav>
</header>

<div class=" mt-4">
    @yield('content')
</div>

<footer class="bg-dark">
    <div>
        <p>&copy;2024 Все права защищены.</p>
    </div>
</footer>

<script>
    $(document).ready(function() {
        $('.add-to-cart-btn').click(function(event) {
            event.preventDefault(); // Предотвращаем стандартное действие кнопки

            // Отправляем AJAX-запрос на сервер для добавления товара в корзину
            $.ajax({
                url: $(this).attr('href'), // URL для добавления товара в корзину
                type: 'POST', // Метод запроса
                data: {}, // Данные, если необходимо
                success: function(response) {
                    // При успешном ответе от сервера, отображаем уведомление
                    $('#cart-notification').html('Товар успешно добавлен в корзину');
                    $('#cart-notification').fadeIn().delay(2000).fadeOut(); // Показываем уведомление на 2 секунды
                },
                error: function(xhr, status, error) {
                    // Обработка ошибок при выполнении AJAX-запроса
                    console.error(error);
                }
            });
        });
    });

</script>
<script src="{{ asset('js/mainJS.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
