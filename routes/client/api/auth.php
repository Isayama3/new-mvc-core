<?php

use App\Http\Controllers\Client\Api\Auth\AuthController;
use App\Http\Controllers\Client\Api\Auth\OTPController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');

Route::post('send-otp', [OTPController::class, 'sendOTP'])->name('send.otp');
Route::post('verify-otp', [OtpController::class, 'verifyOTP'])->name('verify.otp');
