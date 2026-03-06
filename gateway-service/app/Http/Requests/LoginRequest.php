<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [

            'email' => [
                'required',
                'email',
                'max:255'
            ],

            'password' => [
                'required',
                'string'
            ],

        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [

            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',

            'password.required' => 'Password is required',

        ];
    }
}
