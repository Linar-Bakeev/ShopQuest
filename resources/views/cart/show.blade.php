@extends('mainLayout')

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
@section('content')
<div class="content-wrapper">
    @php
        $totalItems = 0;
        $totalPrice = 0;
    @endphp

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <table style="margin-bottom: 10px; border-collapse: collapse;">
                <tr style="text-align: center; font-weight: bold; font-size: 18pt;">
                    <td style="border: 1px solid #000; padding: 5px;">Наименование</td>
                    <td style="border: 1px solid #000; padding: 5px;">Цена</td>
                    <td style="border: 1px solid #000; padding: 5px;">Количество</td>
                    <td style="border: 1px solid #000; padding: 5px;">Общая цена</td>
                </tr>
        @foreach($cart as $productId => $item)
            @php
                $totalItems += $item['quantity'];
                $totalPrice += $item['price'] * $item['quantity'];
            @endphp

                        <tr>
                            <td style="border: 1px solid #000; padding: 5px;">{{ $item['name'] }}</td>
                            <td style="border: 1px solid #000; padding: 5px;">{{ $item['price'] }} руб.</td>
                            <td style="border: 1px solid #000; padding: 5px;">{{ $item['quantity'] }} шт.</td>
                            <td style="border: 1px solid #000; padding: 5px;">{{ $item['price'] * $item['quantity'] }} руб.</td>
                        </tr >

        @endforeach
                <tr style="font-size: 18pt">
                    <td style="border: 1px solid white; padding: 5px; ">Итого</td>
                    <td style="border: 1px solid white; padding: 5px; "></td>
                    <td style="border: 1px solid white; padding: 5px;">{{ $totalItems }} шт.</td>
                    <td style="border: 1px solid white; padding: 5px;">{{ $totalPrice }} руб.</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="cart-actions" style="margin-top: 20px; display: flex; justify-content: space-between;">
        <button class="btn btn-primary" onclick="clearCart()">Очистить корзину</button>
        <form id="place-order-form" action="{{ route('orders.place') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Заказать</button>
        </form>
    </div>
</div>



<script>
    function clearCart() {
        $.ajax({
            type: 'POST',
            url: '{{ route('cart.clear') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                alert('Корзина успешно очищена!');
                location.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function placeOrder() {
        console.log('Заказ размещен!');
    }
</script>
@endsection
