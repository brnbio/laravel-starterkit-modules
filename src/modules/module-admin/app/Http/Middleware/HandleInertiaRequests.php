<?php

declare(strict_types=1);

namespace Admin\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

final class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'admin::app';

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'user'        => $request->user(),
            'sidebarOpen' => $this->isSidebarOpen(),
        ];
    }

    private function isSidebarOpen(): bool
    {
        return request()->hasCookie('sidebar_state') === false
            || request()->cookie('sidebar_state') === 'true';
    }
}
