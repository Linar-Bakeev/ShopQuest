@extends('admin.layout')

@section('content')
    <div class="container">
        <h2 style="text-align: center;">Управление пользователями</h2>
        <a href="{{ route('admin.users.create') }}"  class="btn btn-success mb-3">Добавить пользователя</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роли</th>

                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if ($user->is_seller && !$user->is_admin)
                            Продавец
                        @elseif (!$user->is_admin)
                            Покупатель
                        @elseif (!$user->is_seller && $user->is_admin)
                            Администратор
                        @endif</td>

                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Редактировать</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
