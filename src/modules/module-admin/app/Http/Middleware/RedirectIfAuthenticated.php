<?php

declare(strict_types=1);

namespace Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::guard('web')->check()) {
            return to_route('admin.dashboard');
        }

        return $next($request);
    }
}
