<?php

declare(strict_types=1);

namespace Admin\Http\Controllers;

use Inertia\Response;

final class DashboardController
{
    public function __invoke(): Response
    {
        return inertia('dashboard');
    }
}
