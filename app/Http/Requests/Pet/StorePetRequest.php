<?php

namespace App\Http\Requests\Pet;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'species'   => ['required', 'string', 'max:100'],
            'breed'     => ['nullable', 'string', 'max:100'],
            'birthdate' => ['nullable', 'date'],
        ];
    }
}
