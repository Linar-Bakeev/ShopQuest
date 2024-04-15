@extends('mainLayout')

@section('content')
    <div class="container mt-4">
        <div id="mainScreen">
            <h2 class="mb-4">Личные данные</h2>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <p><strong>Имя:</strong> {{ $user->first_name }}</p>
                    <p><strong>Фамилия:</strong> {{ $user->last_name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <button class="btn btn-primary btn-sm" onclick="showEditScreen()">Редактировать</button>
                </div>
            </div>

            <h2 class="mb-4">Текущие заказы</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    @if ($orders->count() > 0)
                        <ul class="list-group">
                            @foreach ($orders as $order)
                                <li class="list-group-item">
                                    <a href="{{ route('orders.show', $order->id) }}">Заказ №{{ $order->id }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>У вас нет текущих заказов.</p>
                    @endif
                </div>
            </div>
        </div>

        <div id="editScreen" style="display: none;">
            <h2 class="mb-4">Редактировать данные</h2>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="first_name">Имя</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name">Фамилия</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                        <button type="button" class="btn btn-secondary" onclick="showMainScreen()">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showEditScreen() {
            document.getElementById('mainScreen').style.display = 'none';
            document.getElementById('editScreen').style.display = 'block';
        }

        function showMainScreen() {
            document.getElementById('editScreen').style.display = 'none';
            document.getElementById('mainScreen').style.display = 'block';
        }
    </script>
@endsection
