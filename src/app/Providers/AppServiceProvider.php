<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->strictMode();
        $this->defaults();
        $this->flash();
    }

    private function strictMode(): void
    {
        Date::use(CarbonImmutable::class);
        Model::shouldBeStrict(app()->isLocal());
        Model::automaticallyEagerLoadRelationships();
    }

    private function defaults(): void
    {
        Number::useLocale('de');
        Number::useCurrency('EUR');
        JsonResource::withoutWrapping();
        Password::defaults(fn() => Password::min(8)->max(48)->mixedCase()->numbers()->symbols());
    }

    private function flash(): void
    {
        Inertia::macro('success', function(string $message) {
            $toast = Inertia::getFlashed()['toast'] ?? [];
            $toast[] = [ 'type' => 'success', 'message' => $message ];
            Inertia::flash('toast', $toast);
        });
        Inertia::macro('error', function(string $message) {
            $toast = Inertia::getFlashed()['toast'] ?? [];
            $toast[] = [ 'type' => 'error', 'message' => $message ];
            Inertia::flash('toast', $toast);
        });
    }
}
