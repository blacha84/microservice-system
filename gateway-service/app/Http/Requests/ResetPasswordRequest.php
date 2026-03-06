<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'token' => [
                'required'
            ],

            'email' => [
                'required',
                'email',
                'max:255'
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',

            'password.required' => 'Password is required',
            'password.min' => 'Password must have at least 6 characters',
            'password.confirmed' => 'Passwords must match',
        ];
    }
}
