@extends('mainLayout')

@section('title', 'Главная')

@section('content')
    <div class="">
        <main class="container py-5">
            <div class="row g-3">
                @foreach ($products as $product)
                    <div style="margin-bottom: 25px;" class="col-md-4">
                        <div class="card h-100">
                            @if($product->images->first())
                                <img src="{{ $product->images->first()->url }}" class="card-img-top" alt="Изображение {{ $product->name }}" style="max-height: 150px; object-fit: contain; margin-bottom: 20px;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">
                                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                </h4>
                                <p>{{ \Illuminate\Support\Str::limit($product->description, 30, '...') }}</p>
                                <span style="color: #007bff; font-size: 20px;">
                                <p class="card-text">{{ $product->price }} руб.</p>
                            </span>
                                <form action="{{ route('cart.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary">+</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="margin-top: 20px;">
                <label for="perPageSelect">Показывать по:</label>
                <select id="perPageSelect" onchange="changePerPage(this)">
                    <option value="3" {{ $products->perPage() == 3 ? 'selected' : '' }}>3</option>
                    <option value="6" {{ $products->perPage() == 6 ? 'selected' : '' }}>6</option>
                    <option value="12" {{ $products->perPage() == 12 ? 'selected' : '' }}>12</option>
                    <option value="24" {{ $products->perPage() == 24 ? 'selected' : '' }}>24</option>
                </select>
            </div>

            <div style="margin-top: 20px; align-content: center">
                {{ $products->links() }}
            </div>
        </main>
    </div>
@endsection

