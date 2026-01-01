<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hubungi-kami', [HomeController::class, 'chat'])->name('chat');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk/{store}', [ProdukController::class, 'showStore'])->name('produk.store');
Route::get('/cart', [ProdukController::class, 'showCart'])->name('cart');
Route::post('/cart/add', [ProdukController::class, 'addToCart'])->middleware('auth')->name('cart.add');
Route::post('/cart/update/{index}/{action}', [ProdukController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{index}', [ProdukController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/cart/apply-promo', [ProdukController::class, 'applyPromoCode'])->name('cart.applyPromo');

// Dashboard routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
});

// Admin dashboard routes
Route::middleware(['auth', \App\Http\Middleware\AdminRoleMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/order/{orderId}/status', [\App\Http\Controllers\AdminDashboardController::class, 'updateOrderStatus'])->name('order.updateStatus');
        Route::post('/store/update', [\App\Http\Controllers\AdminDashboardController::class, 'updateStoreDetails'])->name('store.update');

        // Admin produk routes
        Route::get('/produk', [\App\Http\Controllers\AdminProdukController::class, 'index'])->name('produk.index');
        Route::get('/produk/create', [\App\Http\Controllers\AdminProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk', [\App\Http\Controllers\AdminProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{produk}/edit', [\App\Http\Controllers\AdminProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{produk}', [\App\Http\Controllers\AdminProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{produk}', [\App\Http\Controllers\AdminProdukController::class, 'destroy'])->name('produk.destroy');

        // Admin promo codes routes
        Route::resource('promo_codes', \App\Http\Controllers\AdminPromoCodeController::class);

        // Admin couriers routes
        Route::resource('couriers', \App\Http\Controllers\AdminCourierController::class);

        // Admin users routes
        Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/orders', [\App\Http\Controllers\AdminUserController::class, 'showOrders'])->name('users.orders');

        // Admin orders routes
        Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
        Route::post('/order/{orderId}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('order.updateStatus');

        // Admin orders routes
        Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
        Route::post('/order/{orderId}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('order.updateStatus');
    });

Route::get('/checkout', [ProdukController::class, 'showCheckout'])->middleware('auth')->name('checkout');
Route::post('/checkout', [ProdukController::class, 'processCheckout'])->middleware('auth')->name('checkout.process');
Route::get('/order/confirmation/{order}', [ProdukController::class, 'showOrderConfirmation'])->middleware('auth')->name('order.confirmation');
Route::get('/transfer/instructions/{order}', [ProdukController::class, 'showTransferInstructions'])->middleware('auth')->name('transfer.instructions');
Route::get('/orders', [ProdukController::class, 'showOrders'])->middleware('auth')->name('orders');
Route::get('/tips', [TipsController::class, 'index'])->name('tips');
Route::get('/tips/{id}', [TipsController::class, 'show'])->name('tips.show');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
