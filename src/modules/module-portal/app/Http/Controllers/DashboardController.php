<?php

declare(strict_types=1);

namespace Portal\Http\Controllers;

use Inertia\Response;

final class DashboardController
{
    public function __invoke(): Response
    {
        return inertia('dashboard');
    }
}
