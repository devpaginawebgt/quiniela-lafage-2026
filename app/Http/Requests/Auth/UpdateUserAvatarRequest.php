<?php

namespace App\Http\Requests\Auth;

use App\Models\Country;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateUserAvatarRequest extends FormRequest
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
            'avatar_id' => ['required', 'integer', 'exists:avatars,id'],
        ];
    }

    public function messages()
    {
        return [
            'avatar_id.required' => 'Selecciona el avatar a utilizar.',
            'avatar_id.integer'  => 'El avatar seleccionado es inválido.',
            'avatar_id.exists'   => 'El avatar seleccionado no existe en el listado.',
        ];
    }
}
