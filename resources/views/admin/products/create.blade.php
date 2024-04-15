@extends('admin.layout')

@section('content')
    <div class="container">
        <h2>Добавление нового товара</h2>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="seller_id">Продавец:</label>
                <select class="form-control" id="seller_id" name="seller_id" required>
                    @foreach ($sellers as $seller)
                        <option value="{{ $seller->id }}">{{ $seller->first_name }} {{ $seller->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Цена:</label>
                <input type="text" class="form-control" id="price" name="price" required>
                @error('price')
                <div class="text-danger">Цена не может быть отрицательной!</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="images">Изображения товара</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="images" name="images[]" multiple onchange="handleFileSelect(event)">
                    <label class="custom-file-label" for="images" id="fileLabel">Выберите файл</label>
                </div>
                <div id="preview"></div>
            </div>

            <button type="submit" class="btn btn-success">Добавить товар</button>
        </form>
    </div>

    <script>
        function handleFileSelect(event) {
            const files = event.target.files;
            const preview = document.getElementById('preview');

            preview.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = 'auto';
                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            }

            document.getElementById('fileLabel').innerText = files.length + (files.length > 1 ? ' не выбран файл' : ' выбран файл');
        }
    </script>

@endsection
