@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Детали заказа</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $order->id }}">
                                <label for="status">Изменить статус:</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Ожидает подтверждения" {{ $order->status == 'pending' ? 'selected' : '' }}>Ожидает подтверждения</option>
                                    <option value="Идёт сборка" {{ $order->status == 'processing' ? 'selected' : '' }}>Идёт сборка</option>
                                    <option value="Доставляется" {{ $order->status == 'shipping' ? 'selected' : '' }}>Доставляется</option>
                                    <option value="Доставлен" {{ $order->status == 'delivered' ? 'selected' : '' }}>Доставлен</option>
                                    <option value="Отменён" {{ $order->status == 'canceled' ? 'selected' : '' }}>Отменён</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>

                        <h5 class="mt-4">Товары:</h5>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>Наименование</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Общая стоимость</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['price'] }} руб.</td>
                                    <td>{{ $product['quantity'] }}</td>
                                    <td>{{ $product['price'] * $product['quantity'] }} руб.</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
