<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductManager;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Маршрут представления welcome
Route::get('/', [WelcomeController::class, 'index'])->name('main');

// Авторизация
Route::get('/auth', function () {
    return view('auth');
})->name('login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Регистрация
Route::get('/register', function () {
    return view('reg');
});
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Панель управления
Route::group(['middleware' => 'auth'], function () {
    Route::get('/controlPanel', function () {
        return view('controlPanel');
    })->name('CPp')->middleware('seller');
});

// Маршруты для продавцов
Route::middleware(['auth', 'seller'])->group(function () {
    Route::get('/products', [ProductManager::class, 'sellerIndex'])->name('CPp.index');
    Route::get('/products/create', [ProductManager::class, 'create'])->name('CPp.create');
    Route::resource('products', ProductManager::class)->except(['index', 'create']);
});


// Маршруты для администраторов
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.index');
    Route::get('/admin/products', [AdminController::class, 'showProducts'])->name('admin.products.index');
    Route::get('/admin/orders', [AdminController::class, 'showOrders'])->name('admin.orders.index');
    Route::resource('order', OrderController::class)->only(['show', 'update']);
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/{order}', [OrderController::class, 'updateStatus'])->name('admin.orders.update');
});

// Просмотр товара
Route::get('product/{product}', [ProductManager::class, 'show'])->name('product.show');

// Корзина
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Заказ
Route::get('/orders/{id}', [OrderController::class, 'showOrder'])->name('orders.show');
Route::post('/orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');

// Профиль пользователя
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
Route::put('/profile/{user}', [UserController::class, 'updateProfile'])->name('user.update');

