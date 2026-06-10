<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'nombres'      => ['required', 'string', 'min:2', 'max:60'],
            'apellidos'    => ['required', 'string', 'min:2', 'max:60'],
            'email'        => ['required', 'email',  'min:5', 'max:255', Rule::unique('users')->whereNull('deleted_at')],
            'password'     => ['required', 'confirmed', Password::defaults()],
            'user_type_id' => ['required', 'integer', 'exists:user_types,id'],
            'pais_id'      => ['required', 'integer', 'exists:countries,id'],

            'code' => [
                'nullable',
                'required_if:user_type_id,1',
                'prohibited_unless:user_type_id,1',
                'string',
                'size:8',
                'exists:codigos,codigo'
            ],

            'accepted_terms_version' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            // NOMBRES
            'nombres.required' => 'Por favor, ingrese su nombre.',
            'nombres.string'   => 'El campo nombre debe contener texto.',
            'nombres.min'      => 'El campo nombre debe contener al menos 2 caracteres.',
            'nombres.max'      => 'El campo nombre no debe superar los 60 caracteres.',

            // APELLIDOS
            'apellidos.required' => 'Por favor, ingrese su apellido.',
            'apellidos.string'   => 'El campo apellido debe contener texto.',
            'apellidos.min'      => 'El campo apellido debe contener al menos 2 caracteres.',
            'apellidos.max'      => 'El campo apellido no debe superar los 60 caracteres.',

            // EMAIL
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email'    => 'Por favor ingrese un correo electrónico válido.',
            'email.min'      => 'El correo electrónico debe contener al menos 5 caracteres.',
            'email.max'      => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique'   => 'Ya existe un usuario registrado con este correo electrónico.',

            //  USER TYPE
            'user_type_id.required' => 'El tipo de usuario es incorrecto.',
            'user_type_id.integer'  => 'El tipo de usuario es incorrecto.',
            'user_type_id.exists'   => 'No se encontró el tipo de usuario.',

            // PAIS
            'pais_id.required' => 'Por favor, seleccione su país.',
            'pais_id.integer'  => 'El país seleccionado es incorrecto.',
            'pais_id.exists'   => 'El país seleccionado no es válido.',

            // CODIGO
            'code.required_if'       => 'Por favor, ingrese su código de acceso.',
            'code.prohibited_unless' => 'El código de acceso solo aplica para usuarios de tipo Dependiente.',
            'code.string'            => 'El código de acceso debe ser un texto válido.',
            'code.size'              => 'El código de acceso debe tener exactamente 8 caracteres.',
            'code.exists'            => 'El código de acceso no existe.',

            // ACCEPTED TERMS VERSION
            'accepted_terms_version.required' => 'Debe aceptar los términos y condiciones.',
            'accepted_terms_version.string'   => 'La versión de términos aceptados debe ser un texto válido.',
            'accepted_terms_version.max'      => 'La versión de términos aceptados no puede tener más de 20 caracteres.',
        ];
    }
}
