<?php

namespace App\Http\Requests\UserPushToken;

use App\Http\Services\HelperService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPushTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'device_token' => ['required', 'string', 'min:1', 'max:1024'],
            'device_platform' => ['required', 'string', Rule::in(['android', 'ios'])],
            'is_active' => ['boolean'],
        ];
    }

    public function messages()
    {
        return [
            'device_token.required' => 'El token del dispositivo es obligatorio.',
            'device_token.string' => 'El token del dispositivo debe ser texto válido.',
            'device_token.min' => 'El token del dispositivo no puede estar vacío.',
            'device_token.max' => 'El token del dispositivo excede el tamaño permitido.',

            'device_platform.required' => 'Debe especificar el tipo de dispositivo.',
            'device_platform.string' => 'El campo tipo de dispositivo debe ser texto.',
            'device_platform.in' => 'El dispositivo debe ser Android o iOS.',

            'is_active.boolean' => 'El valor del campo activo debe ser verdadero o falso.',
        ];
    }

}
