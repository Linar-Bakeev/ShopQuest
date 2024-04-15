@extends('admin.layout')

@section('content')
    <div class="container">
        <h2>Редактирование товара</h2>
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Изображение товара</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" onchange="previewImage(this);">
                    <label class="custom-file-label" for="image">Выберите файл</label>
                </div>
                <div id="imagePreview" style="margin-top: 10px; display: flex; align-items: center;">
                    @if($product->images()->exists())
                        <div style="margin-right: 20px;">
                            <p>Сейчас на сайте:</p>
                            <img src="{{ asset($product->images->first()->url) }}" alt="Current Image" style="width: 100px; height: auto;">
                        </div>
                    @endif
                    <div style="margin-left: 20px; border-left: 1px solid black; padding-left: 20px;">
                        <p>Новое изображение:</p>
                        <div id="newImagePreview"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Название товара</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3" >{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" step="0.01" required>
                @error('price')
                <div class="text-danger">Цена не может быть отрицательной!</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Обновить товар</button>
        </form>
    </div>
@endsection
