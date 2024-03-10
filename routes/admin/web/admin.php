<?php

use App\Http\Controllers\Admin\Web\AuthController;
use App\Http\Controllers\Admin\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('profile', [AuthController::class, 'updateProfileView'])->name('profile.view');
Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.post');
Route::get('home', [HomeController::class, 'index'])->name('home');

// Route::resource('admins', 'AdminController');
// Route::resource('roles', 'RoleController');
Route::resource('categories', 'CategoryController');
Route::resource('clients', 'ClientController');
Route::resource('client-cars', 'ClientCarController');
Route::resource('client-addresses', 'ClientAddressController');
Route::resource('categories', 'CategoryController');
Route::resource('brands', 'BrandController');
Route::resource('services', 'ServiceController');
Route::resource('products', 'ProductController');
Route::resource('delivery-plans', 'DeliveryPlanController');
Route::resource('orders', 'OrderController');
Route::resource('bookings', 'BookingController');

Route::get('admins/toggle-boolean/{id}/{action}', 'AdminController@toggleBoolean')->name('admins.toggleBoolean');
Route::get('services/toggle-boolean/{id}/{action}', 'ServiceController@toggleBoolean')->name('services.toggleBoolean');
Route::get('products/toggle-boolean/{id}/{action}', 'ProductController@toggleBoolean')->name('products.toggleBoolean');
