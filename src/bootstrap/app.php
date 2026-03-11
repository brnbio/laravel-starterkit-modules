<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function(Middleware $middleware) {
        $middleware->web([ AddLinkHeadersForPreloadedAssets::class ]);
    })
    ->withProviders([ AppServiceProvider::class ])
    ->withExceptions(function(Exceptions $exceptions) {})
    ->create();
