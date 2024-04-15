@extends('admin.layout')

@section('content')
    <div class="container">
        <h2>Редактирование пользователя</h2>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="last_name">Фамилия:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
            </div>
            <div class="form-group">
                <label for="first_name">Имя:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
            </div>

            <div class="form-group">
                <label for="email">Электронная почта:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label for="role">Роль:</label>
                <select class="form-control" id="role" name="role">
                    <option value="seller" {{ $user->is_seller ? 'selected' : '' }}>Продавец</option>
                    <option value="admin" {{ !$user->is_seller && $user->is_admin ? 'selected' : '' }}>Администратор</option>
                    <option value="buyer" {{ !$user->is_seller && !$user->is_admin ? 'selected' : '' }}>Покупатель</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection
