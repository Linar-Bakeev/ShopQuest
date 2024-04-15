@extends('admin.layout')

@section('content')
    <div class="container">
        <h2>Добавление нового пользователя</h2>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="first_name">Имя:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Фамилия:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>

            <div class="form-group">
                <label for="email">Электронная почта:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="role">Роль:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin">Администратор</option>
                    <option value="seller">Продавец</option>
                    <option value="buyer">Покупатель</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Добавить пользователя</button>
        </form>
    </div>
@endsection
