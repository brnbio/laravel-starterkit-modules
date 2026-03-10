<?php

declare(strict_types=1);

namespace Portal\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Portal\Http\Middleware\HandleInertiaRequests;

final class PortalServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes();
        $this->views();
    }

    private function routes(): void
    {
        Route::middleware(['web', HandleInertiaRequests::class])
            ->name('portal.')
            ->group(__DIR__ . '/../../routes/web.php');
    }

    private function views(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'portal');
    }
}
