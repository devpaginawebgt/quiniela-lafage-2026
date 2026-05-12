<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class VerifyResetCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'code'  => ['required', 'string', 'digits:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email'    => 'Por favor ingrese un correo electrónico válido.',
            'email.max'      => 'El correo electrónico no debe superar los 255 caracteres.',

            'code.required' => 'Por favor, ingrese el código de verificación.',
            'code.string'   => 'El código de verificación no es válido.',
            'code.digits'   => 'El código debe contener 6 dígitos.',
        ];
    }

    public function ensureIsNotRateLimited(): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 10)) {

            $seconds = RateLimiter::availableIn($this->throttleKey());

            $minutes = ceil($seconds / 60);

            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => $minutes,
                ]),
            ]);

        }
    }

    public function hitRateLimiter(): void
    {
        RateLimiter::hit($this->throttleKey(), 600);
    }

    public function throttleKey(): string
    {
        return 'pwd-verify|' . Str::lower($this->input('email')) . '|' . $this->ip();
    }
}
