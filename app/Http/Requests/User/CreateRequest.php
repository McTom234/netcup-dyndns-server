<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->uncompromised()],
            'is_admin' => ['boolean'],
            'is_dyndns_client' => ['boolean'],
        ];
    }
}
