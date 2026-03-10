<?php

declare(strict_types=1);

namespace Portal\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

final class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'portal::portal';

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'user'  => $request->user('portal'),
            'flash' => fn() => session('flash_notification', []),
        ];
    }
}
