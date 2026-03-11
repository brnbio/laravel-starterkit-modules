<?php

declare(strict_types=1);

namespace Admin\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            User::ATTRIBUTE_EMAIL    => [
                'required',
                'email',
            ],
            User::ATTRIBUTE_PASSWORD => [
                'required',
                'string',
            ],
        ];
    }
}
