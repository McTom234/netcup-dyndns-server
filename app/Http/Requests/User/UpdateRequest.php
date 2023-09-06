<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['sometimes', 'email', Rule::exists(User::class, 'email')],
            'password' => ['sometimes', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->uncompromised()],
            'is_admin' => ['boolean'],
            'is_dyndns_client' => ['boolean'],
        ];
    }
}
