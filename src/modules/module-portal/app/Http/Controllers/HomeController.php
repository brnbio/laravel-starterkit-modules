<?php

declare(strict_types=1);

namespace Portal\Http\Controllers;

use Inertia\Response;

final class HomeController
{
    public function __invoke(): Response
    {
        return inertia('home');
    }
}
