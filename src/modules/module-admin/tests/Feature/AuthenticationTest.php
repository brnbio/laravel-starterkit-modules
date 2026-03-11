<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

describe('authentication', function () {

    test('users can view the login page', function () {
        $response = $this->get(route('admin.login'));
        $response->assertOk();
    });

    test('users can authenticate with valid credentials', function () {
        /** @var User $user */
        $user = User::factory()->create([
            User::ATTRIBUTE_PASSWORD => 'password123',
        ]);
        $response = $this->post(route('admin.login.store'), [
            User::ATTRIBUTE_EMAIL    => $user->email,
            User::ATTRIBUTE_PASSWORD => 'password123',
        ]);
        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    });

    test('users cannot authenticate with invalid password', function () {
        /** @var User $user */
        $user = User::factory()->create([
            User::ATTRIBUTE_PASSWORD => 'password123',
        ]);
        $response = $this->post(route('admin.login.store'), [
            User::ATTRIBUTE_EMAIL    => $user->email,
            User::ATTRIBUTE_PASSWORD => 'wrong-password',
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    });

    test('users cannot authenticate with non-existent email', function () {
        $response = $this->post(route('admin.login.store'), [
            User::ATTRIBUTE_EMAIL    => 'nonexistent@example.com',
            User::ATTRIBUTE_PASSWORD => 'password123',
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    });

    test('email field is required for login', function () {
        $response = $this->post(route('admin.login.store'), [
            User::ATTRIBUTE_PASSWORD => 'password123',
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_EMAIL);
        $this->assertGuest();
    });

    test('password field is required for login', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $response = $this->post(route('admin.login.store'), [
            User::ATTRIBUTE_EMAIL => $user->email,
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_PASSWORD);
        $this->assertGuest();
    });

    test('authenticated users can logout', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post(route('admin.logout'));
        $response->assertRedirect(route('admin.dashboard'));
        $this->assertGuest();
    });

    test('guests cannot access protected routes', function () {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    });
});

describe('password reset', function () {

    test('users can view the forgot password page', function () {
        $response = $this->get(route('admin.password.request'));
        $response->assertOk();
    });

    test('users can request a password reset link', function () {
        Notification::fake();
        /** @var User $user */
        $user = User::factory()->create();
        $response = $this->post(route('admin.password.email'), [
            User::ATTRIBUTE_EMAIL => $user->email,
        ]);
        $response->assertRedirect();
        Notification::assertSentTo($user, ResetPassword::class);
    });

    test('email is required for password reset request', function () {
        $response = $this->post(route('admin.password.email'));
        $response->assertSessionHasErrors(User::ATTRIBUTE_EMAIL);
    });

    test('email must be valid for password reset request', function () {
        $response = $this->post(route('admin.password.email'), [
            User::ATTRIBUTE_EMAIL => 'not-an-email',
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_EMAIL);
    });

    test('password reset fails for non-existent email', function () {
        $response = $this->post(route('admin.password.email'), [
            User::ATTRIBUTE_EMAIL => 'nonexistent@example.com',
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_EMAIL);
    });

    test('users can view the reset password page with valid token', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $token = Password::broker('users')->createToken($user);
        $response = $this->get(route('admin.password.reset', ['token' => $token]) . '?' . User::ATTRIBUTE_EMAIL . '=' . $user->email);
        $response->assertOk();
    });

    test('users can reset their password with valid token', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $token = Password::broker('users')->createToken($user);
        $response = $this->post(route('admin.password.store'), [
            'token'                 => $token,
            User::ATTRIBUTE_EMAIL    => $user->email,
            User::ATTRIBUTE_PASSWORD => 'NewPassword123!',
            'password_confirmation'  => 'NewPassword123!',
        ]);
        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
        expect(Hash::check('NewPassword123!', $user->fresh()->password))->toBeTrue();
    });

    test('password reset fails with invalid token', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $response = $this->post(route('admin.password.store'), [
            'token'                 => 'invalid-token',
            User::ATTRIBUTE_EMAIL    => $user->email,
            User::ATTRIBUTE_PASSWORD => 'NewPassword123!',
            'password_confirmation'  => 'NewPassword123!',
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_EMAIL);
        $this->assertGuest();
    });

    test('password reset requires password confirmation', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $token = Password::broker('users')->createToken($user);
        $response = $this->post(route('admin.password.store'), [
            'token'                 => $token,
            User::ATTRIBUTE_EMAIL    => $user->email,
            User::ATTRIBUTE_PASSWORD => 'NewPassword123!',
            'password_confirmation'  => 'DifferentPassword123!',
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_PASSWORD);
    });

    test('password reset requires minimum length', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $token = Password::broker('users')->createToken($user);
        $response = $this->post(route('admin.password.store'), [
            'token'                 => $token,
            User::ATTRIBUTE_EMAIL    => $user->email,
            User::ATTRIBUTE_PASSWORD => 'short',
            'password_confirmation'  => 'short',
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_PASSWORD);
    });

    test('password reset requires email', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $token = Password::broker('users')->createToken($user);
        $response = $this->post(route('admin.password.store'), [
            'token'                 => $token,
            User::ATTRIBUTE_PASSWORD => 'NewPassword123!',
            'password_confirmation'  => 'NewPassword123!',
        ]);
        $response->assertSessionHasErrors(User::ATTRIBUTE_EMAIL);
    });

    test('password reset requires token', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $response = $this->post(route('admin.password.store'), [
            User::ATTRIBUTE_EMAIL    => $user->email,
            User::ATTRIBUTE_PASSWORD => 'NewPassword123!',
            'password_confirmation'  => 'NewPassword123!',
        ]);
        $response->assertSessionHasErrors();
    });

    test('password reset url contains admin route', function () {
        Notification::fake();
        /** @var User $user */
        $user = User::factory()->create();

        $this->post(route('admin.password.email'), [
            User::ATTRIBUTE_EMAIL => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
            $url = $notification->toMail($user)->actionUrl;
            expect($url)
                ->toContain('/admin/reset-password/')
                ->toContain(urlencode($user->getEmailForPasswordReset()));

            return true;
        });
    });

    test('authenticated users cannot access forgot password page', function () {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('admin.password.request'));
        $response->assertRedirect('/admin');
    });
});
