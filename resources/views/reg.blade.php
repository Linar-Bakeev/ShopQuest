<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="{{asset('css/styleLog.css')}}">
</head>
<body>
<div class="container">
<form method="post" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <label class="form-label" for="login">Логин</label>
        <input class="form-control" id="login" type="text" name="login" required autofocus>
    </div>

    <div class="form-group">
        <label class="form-label" for="password">Пароль</label>
        <input class="form-control" id="password" type="password" name="password" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="last_name">Фамилия</label>
        <input class="form-control" id="last_name" type="text" name="last_name" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="first_name">Имя</label>
        <input class="form-control" id="first_name" type="text" name="first_name" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input class="form-control" id="email" type="email" name="email" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="role">Статус продавца</label>
        <select id="role" name="role" required>
            <option value="0">Нет</option>
            <option value="1">Да</option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn">Зарегистрироваться</button>
    </div>
    </form>
    <form method="get" action="{{route('main')}}">
        @csrf
        <input type="hidden" name="_method" value="GET">
        <button class="btn">На главную</button>
    </form>
</div>
</body>
</html>
