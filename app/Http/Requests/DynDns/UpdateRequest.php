<?php

namespace App\Http\Requests\DynDns;

use App\Http\Requests\ApiFormRequest;

class UpdateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'hostname' => ['required', 'string'],
            'myip' => ['required', 'ipv4'],
        ];
    }
}
