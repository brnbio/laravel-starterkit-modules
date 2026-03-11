<?php

declare(strict_types=1);

use function Pest\Laravel\get;

test('home page is accessible', function () {
    $response = get(route('portal.home'));
    $response->assertOk();
});