<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LafageRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombres'                => ['required', 'string', 'min:2', 'max:60'],
            'apellidos'              => ['required', 'string', 'min:2', 'max:60'],
            'email'                  => ['required', 'email', 'min:5', 'max:255', 'unique:users'],
            'pais_id'                => ['required', 'integer', 'exists:countries,id'],
            'line_id'                => ['required', 'integer', 'exists:lines,id'],
            'password'               => ['required', 'confirmed', Password::defaults()],
            'accepted_terms_version' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombres.required'   => 'Por favor, ingrese su nombre.',
            'nombres.string'     => 'El campo nombre debe contener texto.',
            'nombres.min'        => 'El campo nombre debe contener al menos 2 caracteres.',
            'nombres.max'        => 'El campo nombre no debe superar los 60 caracteres.',

            'apellidos.required' => 'Por favor, ingrese su apellido.',
            'apellidos.string'   => 'El campo apellido debe contener texto.',
            'apellidos.min'      => 'El campo apellido debe contener al menos 2 caracteres.',
            'apellidos.max'      => 'El campo apellido no debe superar los 60 caracteres.',

            'email.required'     => 'Por favor, ingrese su correo electrónico.',
            'email.email'        => 'Por favor ingrese un correo electrónico válido.',
            'email.min'          => 'El correo electrónico debe contener al menos 5 caracteres.',
            'email.max'          => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique'       => 'Ya existe un usuario registrado con este correo electrónico.',

            'pais_id.required'   => 'El país es requerido.',
            'pais_id.integer'    => 'El país seleccionado no es válido.',
            'pais_id.exists'     => 'El país seleccionado no existe en nuestros registros.',

            'line_id.required'   => 'Por favor, seleccione una línea.',
            'line_id.integer'    => 'La línea seleccionada no es válida.',
            'line_id.exists'     => 'La línea seleccionada no existe en nuestros registros.',

            'accepted_terms_version.required' => 'Debe aceptar los términos y condiciones.',
            'accepted_terms_version.string'   => 'La versión de términos aceptados debe ser un texto válido.',
            'accepted_terms_version.max'      => 'La versión de términos aceptados no puede tener más de 20 caracteres.',
        ];
    }
}
