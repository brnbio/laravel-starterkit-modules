<?php

declare(strict_types=1);

namespace Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class Authenticate
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::guard('web')->check() === false) {
            return to_route('admin.login');
        }

        return $next($request);
    }
}
