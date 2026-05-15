<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/', [StoreController::class, 'index'])->name('home');
Route::get('/shop', [StoreController::class, 'shop'])->name('shop');
Route::get('/categories', [StoreController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [StoreController::class, 'category'])->name('category');
Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::get('/about', [StoreController::class, 'about'])->name('about');

Route::post('/add-to-cart', [StoreController::class, 'addToCart'])->name('add-to-cart');
Route::post('/update-cart', [StoreController::class, 'updateCart'])->name('update-cart');
Route::post('/remove-from-cart', [StoreController::class, 'removeFromCart'])->name('remove-from-cart');
Route::get('/cart/count', [StoreController::class, 'cartCount']);

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [StoreController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place-order');
    Route::get('/order/success/{orderId}', [OrderController::class, 'orderSuccess'])->name('order.success');
    Route::get('/orders', [StoreController::class, 'orders'])->name('orders');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/order/{order}', [AdminController::class, 'showOrder'])->name('admin.order.show');
    Route::post('/order/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.status');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::post('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/products/{product}/delete', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
    Route::get('/products/{product}/delete', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
    Route::post('/products/{product}/delete', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.category.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::get('/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('admin.category.edit');
    Route::post('/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('/categories/{category}/delete', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');
    Route::get('/categories/{category}/delete', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');
    Route::post('/categories/{category}/delete', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/telegram', [AdminController::class, 'telegramBroadcast'])->name('admin.telegram');
    Route::post('/telegram/send', [AdminController::class, 'sendTelegramBroadcast'])->name('admin.telegram.send');
});

require __DIR__.'/auth.php';
