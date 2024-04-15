@extends('mainLayout')

@section('title', $product->name)

@section('content')
<div class="content-wrapper" style="margin-top: 10px;">
    <div class="container">
        <div class="card">
            @if($product->images->first())
                <img src="{{ $product->images->first()->url }}" class="card-img-top" alt="Изображение {{ $product->name }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text"><strong>{{ $product->price }} руб.</strong></p>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px; text-align: center;">
        <button class="btn btn-primary" id="backButton">Назад</button>
    </div>
</div>

@endsection
