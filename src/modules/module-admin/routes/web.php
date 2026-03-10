<?php

declare(strict_types=1);

use Admin\Http\Controllers;
use Admin\Http\Middleware\Authenticate;
use Admin\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

// @formatter:off

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get ('/login',                  [Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login',                  [Controllers\AuthController::class, 'login'])->name('login.store');
    Route::get ('/forgot-password',        [Controllers\AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password',        [Controllers\AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get ('/reset-password/{token}', [Controllers\AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password',         [Controllers\AuthController::class, 'reset'])->name('password.store');
});

Route::middleware(Authenticate::class)->group(function () {
    Route::get ('/',       Controllers\DashboardController::class)->name('dashboard');
    Route::post('/logout', [Controllers\AuthController::class, 'logout'])->name('logout');
});
