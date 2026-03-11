<?php

declare(strict_types=1);

namespace Admin\Http\Controllers;

use Admin\Http\Requests\Account\DeleteUserRequest;
use Admin\Http\Requests\Account\ProfileUpdateRequest;
use Admin\Http\Requests\Account\TwoFactorAuthenticationRequest;
use Admin\Http\Requests\Account\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

use function App\Http\Controllers\flash;

final class AccountController
{
    public function edit(): Response
    {
        return inertia('account/edit');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $user->fill($request->validated());
        if ($user->isDirty(User::ATTRIBUTE_EMAIL)) {
            $user->email_verified_at = null;
        }
        $user->save();
        flash()->success('Ihre Daten wurden erfolgreich aktualisiert.');

        return to_route('account.edit');
    }

    public function destroy(DeleteUserRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        auth()->logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        flash()->success('Ihr Konto wurde erfolgreich gelöscht.');

        return redirect('/');
    }

    public function editPassword(): Response
    {
        return inertia('account/editPassword');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $user->update([
            User::ATTRIBUTE_PASSWORD => $request->validated(User::ATTRIBUTE_PASSWORD),
        ]);
        flash()->success('Ihr Passwort wurde erfolgreich aktualisiert.');

        return to_route('account.password');
    }

    public function twoFactorAuthentication(TwoFactorAuthenticationRequest $request): Response
    {
        $request->ensureStateIsValid();

        return inertia('account/2fa', [
            'twoFactorEnabled' => $request->user()?->hasEnabledTwoFactorAuthentication(),
        ]);
    }

    public function appearance(): Response
    {
        return inertia('account/appearance');
    }
}
