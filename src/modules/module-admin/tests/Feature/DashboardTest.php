<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\get;

test('admin dashboard redirects to login', function () {
    $response = get(route('admin.dashboard'));
    $response->assertRedirect(route('admin.login'));
});

test('admin dashboard is accessible for users', function () {
    $this->actingAs(User::factory()->create());
    $response = get(route('admin.dashboard'));
    $response->assertOk();
});