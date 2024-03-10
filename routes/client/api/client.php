<?php

use App\Http\Controllers\Client\Api\Auth\AuthController;
use App\Http\Controllers\Client\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:client-api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::get('get-profile', [ProfileController::class, 'getProfile'])->name('get.profile');

    Route::resource('client-cars', 'ClientCarController');
    Route::resource('delivery-plans', 'DeliveryPlanController');
    Route::resource('client-addresses', 'ClientAddressController');
    Route::resource('orders', 'OrderController');
    Route::resource('bookings', 'BookingController');
    Route::resource('cart', 'CartController')->except(['show', 'index']);
    Route::resource('notifications', 'NotificationController')->only(['show', 'index', 'destroy']);
    Route::get('get-cart', 'CartController@getUserCart');

    Route::post('toggle-favorite-services', 'ClientFavoriteController@toggleFavoriteServices');
    Route::post('toggle-favorite-products', 'ClientFavoriteController@toggleFavoriteProducts');
    Route::get('favorite', 'ClientFavoriteController@favorite');
    Route::get('favorite-services', 'ClientFavoriteController@favoriteServices');
    Route::get('favorite-products', 'ClientFavoriteController@favoriteProducts');
});

Route::resource('categories', 'CategoryController');
Route::resource('services', 'ServiceController');
Route::resource('products', 'ProductController');
Route::resource('brands', 'BrandController');
