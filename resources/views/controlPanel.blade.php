@extends('mainLayout')

@section('title', 'Панель управления')

@section('content')
    <div class="content-wrapper">
        <main class="container py-5">
            @yield('content')
        </main>
    </div>
@endsection
