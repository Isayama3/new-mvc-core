<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profile', [AuthController::class, 'updateProfileView'])->name('profile.view');
    Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.post');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('admins', AdminController::class);
    Route::get('admins/toggle-boolean/{id}/{action}', 'AdminController@toggleBoolean')->name('admins.toggleBoolean');

    Route::resource('roles', RoleController::class);
});
