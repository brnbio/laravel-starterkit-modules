<?php

declare(strict_types=1);

namespace Admin\Http\Controllers;

use Admin\Http\Requests\ForgotPasswordRequest;
use Admin\Http\Requests\LoginRequest;
use Admin\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

final class AuthController
{
    private const string GUARD = 'web';
    private const string BROKER = 'users';

    public function showLoginForm(): Response
    {
        return inertia('auth/login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::guard(self::GUARD)->attempt($request->validated(), $request->boolean('remember')) === false) {
            throw ValidationException::withMessages([
                User::ATTRIBUTE_EMAIL => [__('auth.failed')],
            ]);
        }
        $request->session()->regenerate();

        return to_route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard(self::GUARD)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('admin.dashboard');
    }

    public function showForgotPasswordForm(): Response
    {
        return inertia('auth/forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request): RedirectResponse
    {
        $response = Password::broker(self::BROKER)->sendResetLink($request->validated());
        if ($response !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                User::ATTRIBUTE_EMAIL => [__($response)],
            ]);
        }
        flash()->success('Sie erhalten per E-Mail einen Link, mit dem Sie ein neues Passwort vergeben können.');

        return redirect('/admin/forgot-password');
    }

    public function showResetPasswordForm(Request $request): Response
    {
        return inertia('auth/reset-password', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function reset(ResetPasswordRequest $request): RedirectResponse
    {
        /** @var string $response */
        $response = Password::broker(self::BROKER)->reset(
            $request->validated(),
            function(User $user, string $password): void {
                $user->update([
                    User::ATTRIBUTE_PASSWORD       => $password,
                    User::ATTRIBUTE_REMEMBER_TOKEN => Str::random(32),
                ]);
                event(new PasswordReset($user));
                Auth::guard(self::GUARD)->login($user);
            },
        );
        if ($response !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                User::ATTRIBUTE_EMAIL => [__($response)],
            ]);
        }
        flash()->success('Passwort erfolgreich zurückgesetzt.');

        return to_route('admin.dashboard');
    }
}
