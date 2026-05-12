<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'       => ['required', 'email', 'max:255'],
            'reset_token' => ['required', 'string', 'size:64'],
            'password'    => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email'    => 'Por favor ingrese un correo electrónico válido.',
            'email.max'      => 'El correo electrónico no debe superar los 255 caracteres.',

            'reset_token.required' => 'El token de recuperación es obligatorio.',
            'reset_token.string'   => 'El token de recuperación no es válido.',
            'reset_token.size'     => 'El token de recuperación no es válido.',

            'password.required'  => 'Por favor llene el campo contraseña.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ];
    }
}
