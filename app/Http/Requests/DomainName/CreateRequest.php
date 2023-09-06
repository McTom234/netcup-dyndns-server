<?php

namespace App\Http\Requests\DomainName;

use App\Http\Requests\ApiFormRequest;
use App\Models\DomainName;
use Illuminate\Validation\Rule;

class CreateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'domain_name' => ['required', 'string', Rule::unique(DomainName::class, 'domain_name')],
        ];
    }
}
