@extends('admin.layout')

@section('content')
    <div class="container">
        <h2 style="text-align: center;">Управление товарами</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-2">Добавить товар</a>
        <table class="table">
            <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if($product->images()->exists())
                            <img src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($product->description, 80, '...') }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary mr-2">Редактировать</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
@endsection
