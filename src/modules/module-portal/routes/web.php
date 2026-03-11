<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Portal\Http\Controllers;

// @formatter:off

Route::get('/', Controllers\HomeController::class)->name('home');