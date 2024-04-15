@extends('admin.layout')

@section('content')
    <div class="py-4" style="text-align: center">
        <h2>Добро пожаловать в Админ-панель</h2>
        <p>Используйте меню для доступа к управлению пользователями, товарами и заказами.</p>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Управление пользователями</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Управление товарами</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Управление заказами</a>
    </div>

@endsection
