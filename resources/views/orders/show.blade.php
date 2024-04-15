@extends('mainLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Детали заказа</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="font-weight-bold">Номер заказа:</span> {{ $order->id }}
                        </div>
                        <div class="mb-3">
                            <span class="font-weight-bold">Общая стоимость:</span> {{ $order->total_price }} руб.
                        </div>
                        <div class="mb-4">
                            <span class="font-weight-bold">Статус:</span>
                            @if ($order->status == 'pending')
                                <span class="badge badge-warning">{{ $order->status }}</span>
                            @elseif ($order->status == 'processed')
                                <span class="badge badge-info">{{ $order->status }}</span>
                            @elseif ($order->status == 'shipped')
                                <span class="badge badge-primary">{{ $order->status }}</span>
                            @else
                                <span class="badge badge-success">{{ $order->status }}</span>
                            @endif
                        </div>
                        <h5 class="mb-3">Товары:</h5>
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
