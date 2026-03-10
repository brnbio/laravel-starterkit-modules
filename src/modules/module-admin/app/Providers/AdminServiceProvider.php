<?php

declare(strict_types=1);

namespace Admin\Providers;

use Admin\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class AdminServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes();
        $this->views();
    }

    private function routes(): void
    {
        Route::middleware([
            'web',
            HandleInertiaRequests::class,
        ])
            ->prefix('admin')
            ->name('admin.')
            ->group(__DIR__ . '/../../routes/web.php');
    }

    private function views(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');
    }
}
