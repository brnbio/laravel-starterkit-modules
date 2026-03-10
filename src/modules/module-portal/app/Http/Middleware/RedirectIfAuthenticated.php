<?php

declare(strict_types=1);

namespace Portal\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('portal')->check()) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
