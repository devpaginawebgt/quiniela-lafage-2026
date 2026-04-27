<?php

namespace App\Http\Requests\Auth;

use App\Http\Services\UserService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_type_id' => ['required', 'integer', 'exists:user_types,id'],
            'identity'     => ['required', 'string', 'min:2', 'max:20'],
            'password'     => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'user_type_id.required' => 'El tipo de usuario es incorrecto.',
            'user_type_id.integer'  => 'El tipo de usuario es incorrecto.',
            'user_type_id.exists'   => 'No se encontró el tipo de usuario.',

            'identity.required' => 'Ingrese su número de documento o colegiado.',
            'identity.string'   => 'El número de documento o colegiado no es válido.',
            'identity.min'      => 'El número de documento o colegiado debe contener como mínimo 2 caracteres.',
            'identity.max'      => 'El número de documento o colegiado debe contener como máximo 20 caracteres.',

            'password.required' => 'Por favor llene el campo contraseña.',
            'password.string'   => 'La contraseña debe contener texto.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $data = $this->validated();
        $userService = app(UserService::class);
        $user = null;

        if ((int) $data['user_type_id'] === 1) {
            $user = $userService->getLoginDependiente($this);
        } elseif ((int) $data['user_type_id'] === 2) {
            $user = $userService->getLoginDoctor($this);
        }

        if (empty($user)) {
            $error_message = match ((int) $data['user_type_id']) {
                1       => 'No se encontró un dependiente registrado con este número de documento.',
                2       => 'No se encontró un doctor registrado con este número de colegiado.',
                default => 'No se encontró un usuario con este número de documento o colegiado.',
            };

            throw ValidationException::withMessages([
                'identity' => $error_message,
            ]);
        }

        $credentials = ['email' => $user->email, 'password' => $data['password']];

        if (! Auth::attempt($credentials)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'identity' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 10)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'identity' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('identity')).'|'.$this->ip();
    }
}
