<?php

declare(strict_types=1);

namespace Portal\Http\Middleware;

use Inertia\Middleware;

final class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'portal::app';
}
