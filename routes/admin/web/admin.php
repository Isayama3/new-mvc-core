<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('login.logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
});
