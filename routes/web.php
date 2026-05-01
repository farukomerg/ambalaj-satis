<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/urunler', [StorefrontController::class, 'products'])->name('products.index');
Route::get('/urunler/{product:slug}', [StorefrontController::class, 'show'])->name('products.show');

Route::middleware('guest')->group(function (): void {
    Route::get('/giris', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/giris', [AuthController::class, 'login'])->name('login.store');
    Route::get('/kayit', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/kayit', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/cikis', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/sepet', [CartController::class, 'index'])->name('cart.index');
    Route::post('/sepet/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/sepet/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/sepet/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/odeme', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/odeme', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/siparislerim', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/siparislerim/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/siparislerim/{order}/iptal', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/siparislerim/{order}/teslim-aldim', [OrderController::class, 'markDelivered'])->name('orders.delivered');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/pasiflestir', [ProfileController::class, 'deactivate'])->name('profile.deactivate');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('products', AdminProductController::class)->except('show');
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/approve', [AdminOrderController::class, 'approve'])->name('orders.approve');
    Route::post('orders/{order}/advance', [AdminOrderController::class, 'advance'])->name('orders.advance');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('users/{user}/toggle', [AdminUserController::class, 'toggle'])->name('users.toggle');
});
