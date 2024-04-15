<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/styleLog.css')}}">
</head>
<body>
<div class="container">
    <h1>Авторизация</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" required autofocus>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Пароль</label>
            <input class="form-control" id="password" type="password" name="password" required>
        </div>

        <div class="form-group">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Запомнить меня</label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Войти</button>
        </div>
    </form>

    <div style="text-align: center;">
        <form method="get" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="_method" value="GET">
            <button class="btn">Ещё не зарегистрировались?</button>
        </form>
    </div>
</div>
</body>
</html>
