<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            User::ATTRIBUTE_NAME           => fake()->name(),
            User::ATTRIBUTE_EMAIL          => fake()->unique()->safeEmail(),
            User::ATTRIBUTE_PASSWORD       => 'password',
            User::ATTRIBUTE_REMEMBER_TOKEN => Str::random(32),
        ];
    }
}
