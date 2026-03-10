<?php

declare(strict_types=1);

namespace Admin\Http\Controllers;

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
    private const string GUARD  = 'web';
    private const string BROKER = 'users';

    public function showLoginForm(): Response
    {
        return inertia('auth/login');
    }

    /** @throws ValidationException */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            User::ATTRIBUTE_USERNAME => ['required', 'string'],
            'password'               => ['required', 'string'],
        ]);
        if (! Auth::guard(self::GUARD)->attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                User::ATTRIBUTE_USERNAME => [__('auth.failed')],
            ]);
        }
        $request->session()->regenerate();

        return redirect('/admin');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard(self::GUARD)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function showForgotPasswordForm(): Response
    {
        return inertia('auth/forgot-password');
    }

    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            User::ATTRIBUTE_EMAIL => ['required', 'email'],
        ]);
        $response = Password::broker(self::BROKER)->sendResetLink(
            $request->only(User::ATTRIBUTE_EMAIL),
        );
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

    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            User::ATTRIBUTE_EMAIL    => ['required', 'email'],
            User::ATTRIBUTE_PASSWORD => ['required', 'between:8,48', 'confirmed'],
            'token'                  => ['required'],
        ]);
        $response = Password::broker(self::BROKER)->reset(
            $request->only(User::ATTRIBUTE_EMAIL, User::ATTRIBUTE_PASSWORD, 'password_confirmation', 'token'),
            function (User $user, string $password): void {
                $user->update([
                    User::ATTRIBUTE_PASSWORD       => $password,
                    User::ATTRIBUTE_REMEMBER_TOKEN => Str::random(100),
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

        return redirect('/admin');
    }
}
