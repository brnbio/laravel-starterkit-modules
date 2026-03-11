<?php

declare(strict_types=1);

namespace Admin\Providers;

use Admin\Http\Middleware\HandleInertiaRequests;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
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
        Route::middleware([ 'web', HandleInertiaRequests::class ])
            ->prefix('admin')
            ->name('admin.')
            ->group(__DIR__ . '/../../routes/web.php');

        ResetPassword::createUrlUsing(function(User $notifiable, string $token) {
            return route('admin.password.reset', [
                'email' => $notifiable->getEmailForPasswordReset(),
                'token' => $token,
            ]);
        });
    }

    private function views(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');
    }
}
