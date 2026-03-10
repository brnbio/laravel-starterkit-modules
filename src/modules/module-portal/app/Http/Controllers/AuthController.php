<?php

declare(strict_types=1);

namespace Portal\Http\Controllers;

use App\Models\Customer;
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
    private const string GUARD  = 'portal';
    private const string BROKER = 'customers';

    public function showLoginForm(): Response
    {
        return inertia('auth/login');
    }

    /** @throws ValidationException */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            Customer::ATTRIBUTE_EMAIL => ['required', 'email'],
            'password'                => ['required', 'string'],
        ]);
        if (! Auth::guard(self::GUARD)->attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                Customer::ATTRIBUTE_EMAIL => [__('auth.failed')],
            ]);
        }
        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard(self::GUARD)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showForgotPasswordForm(): Response
    {
        return inertia('auth/forgot-password');
    }

    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            Customer::ATTRIBUTE_EMAIL => ['required', 'email'],
        ]);
        $response = Password::broker(self::BROKER)->sendResetLink(
            $request->only(Customer::ATTRIBUTE_EMAIL),
        );
        if ($response !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                Customer::ATTRIBUTE_EMAIL => [__($response)],
            ]);
        }
        flash()->success('Sie erhalten per E-Mail einen Link, mit dem Sie ein neues Passwort vergeben können.');

        return redirect('/forgot-password');
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
            Customer::ATTRIBUTE_EMAIL    => ['required', 'email'],
            Customer::ATTRIBUTE_PASSWORD => ['required', 'between:8,48', 'confirmed'],
            'token'                      => ['required'],
        ]);
        $response = Password::broker(self::BROKER)->reset(
            $request->only(Customer::ATTRIBUTE_EMAIL, Customer::ATTRIBUTE_PASSWORD, 'password_confirmation', 'token'),
            function (Customer $customer, string $password): void {
                $customer->update([
                    Customer::ATTRIBUTE_PASSWORD       => $password,
                    Customer::ATTRIBUTE_REMEMBER_TOKEN => Str::random(100),
                ]);
                event(new PasswordReset($customer));
                Auth::guard(self::GUARD)->login($customer);
            },
        );
        if ($response !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                Customer::ATTRIBUTE_EMAIL => [__($response)],
            ]);
        }
        flash()->success('Passwort erfolgreich zurückgesetzt.');

        return redirect('/dashboard');
    }
}
