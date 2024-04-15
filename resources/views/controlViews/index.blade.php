    @extends('mainLayout')

    @section('content')
        <div class="container mt-4">
            <div class="row g-3">
                @foreach ($products as $product)
                    <div style="margin-bottom: 25px;" class="col-md-4">
                        <div class="card h-100">
                            @if($product->images->first())
                                <img src="{{ $product->images->first()->url }}" class="card-img-top" alt="Изображение {{ $product->name }}" style="max-height: 250px; object-fit: contain; margin-bottom: 20px;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">{{ $product->name }}</h4>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 30, '...') }}</p>
                                <span style="color: #007bff; font-size: 20px;"> <p class="card-text">{{ $product->price }} руб.</p></span>
                                <div class="mt-auto">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Редактировать</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="perPageSelect" class="form-label">Количество товаров на странице:</label>
                <select id="perPageSelect" class="form-select">
                    <option value="3" {{ request()->get('perPage') == '3' ? 'selected' : '' }}>3</option>
                    <option value="6" {{ request()->get('perPage') == '6' ? 'selected' : '' }}>6</option>
                    <option value="12" {{ request()->get('perPage') == '12' ? 'selected' : '' }}>12</option>
                    <option value="24" {{ request()->get('perPage') == '24' ? 'selected' : '' }}>24</option>
                </select>
            </div>
            <div style="margin-top: 20px; align-content: center">
                {{ $products->appends(request()->query())->links() }} <!-- Используем метод appends() для сохранения текущих параметров запроса -->
            </div>
        </div>
        <script>
            // Обработчик изменения количества элементов на странице
            document.getElementById('perPageSelect').addEventListener('change', function() {
                var perPage = this.value;
                var currentUrl = window.location.href;

                var url = new URL(currentUrl);
                url.searchParams.set('perPage', perPage);

                window.location.href = url.toString();
            });
        </script>
    @endsection
