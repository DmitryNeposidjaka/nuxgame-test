<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username',
            ],

            'phone' => [
                'required',
                'string',
                'regex:/^\+?[1-9]\d{7,14}$/',
                'unique:users,phone',
            ],
        ];
    }
}
