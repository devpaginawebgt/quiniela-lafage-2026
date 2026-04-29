<?php

namespace App\Http\Requests\Auth;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ApiRegisterRequest extends FormRequest
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
            'nombres'          => ['required', 'string', 'min:2', 'max:40'],
            'apellidos'        => ['required', 'string', 'min:2', 'max:40'],
            'numero_documento' => ['required', 'string', 'min:6', 'max:20', 'unique:users,numero_documento'],
            'email'            => ['required', 'email',  'min:5', 'max:255', 'unique:users'],
            'pais_id'          => ['required', 'integer', 'exists:countries,id'],
            'password'         => ['required', 'confirmed', Password::defaults()],
            'user_type_id'     => ['required', 'integer', 'exists:user_types,id'],

            'company_id' => [
                'nullable',
                'required_if:user_type_id,1',
                'prohibited_unless:user_type_id,1',
                'integer',
                'exists:companies,id',
            ],
            'branch' => [
                'nullable',
                'required_if:user_type_id,1',
                'prohibited_unless:user_type_id,1',
                'string',
                'min:3',
                'max:255',
            ],
            'code' => [
                'nullable', 
                'required_if:user_type_id,1',
                'prohibited_unless:user_type_id,1',
                'string', 
                'size:8',
                'exists:codigos,codigo'
            ],
            'line_id' => [
                'nullable', 
                'required_if:user_type_id,2',
                'prohibited_unless:user_type_id,2',
                'integer', 
                'exists:lines,id'
            ],
            'colegiado' => [
                'nullable',
                'required_if:user_type_id,2',
                'prohibited_unless:user_type_id,2',
                'string',
                'min:2',
                'max:20',
                'unique:users'
            ],

            'accepted_terms_version' => ['required', 'string', 'max:20'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->has('pais_id') || $validator->errors()->has('numero_documento')) {
                return;
            }

            $country = Country::find($this->pais_id);

            if ($country && $country->document_regex && !preg_match("/{$country->document_regex}/", $this->numero_documento)) {
                $validator->errors()->add(
                    'numero_documento',
                    $country->document_regex_message ?? 'El formato del documento no es válido.'
                );
            }
        });
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

            // NUMERO DOCUMENTO
            'numero_documento.required' => 'Por favor, ingrese su número de documento.',
            'numero_documento.string'   => 'El número de documento debe ser un texto válido.',
            'numero_documento.min'      => 'El número de documento debe tener al menos 6 caracteres.',
            'numero_documento.max'      => 'El número de documento no puede tener más de 20 caracteres.',
            'numero_documento.unique'   => 'Ya existe un usuario registrado con este número de documento.',

            // EMAIL
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email'    => 'Por favor ingrese un correo electrónico válido.',
            'email.min'      => 'El correo electrónico debe contener al menos 5 caracteres.',
            'email.max'      => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique'   => 'Ya existe un usuario registrado con este correo electrónico.',

            // PAIS
            'pais_id.required' => 'Por favor seleccione su país.',
            'pais_id.integer'  => 'El país seleccionado no es válido.',
            'pais_id.exists'   => 'El país seleccionado no existe en nuestros registros.',

            //  USER TYPE
            'user_type_id.required' => 'El tipo de usuario es incorrecto.',
            'user_type_id.integer'  => 'El tipo de usuario es incorrecto.',
            'user_type_id.exists'   => 'No se encontró el tipo de usuario.',

            // CODIGO
            'code.required_if'       => 'Por favor, ingrese su código de acceso.',
            'code.prohibited_unless' => 'El código de acceso solo aplica para usuarios de tipo Dependiente.',
            'code.string'            => 'El código de acceso debe ser un texto válido.',
            'code.size'              => 'El código de acceso debe tener exactamente 8 caracteres.',
            'code.exists'            => 'El código de acceso no existe.',

            // COMPANY
            'company_id.required_if'       => 'Por favor, seleccione la cadena de farmacias para la cuál labora.',
            'company_id.prohibited_unless' => 'El campo cadena solo aplica para usuarios tipo dependiente.',
            'company_id.integer'           => 'La cadena seleccionada no es válida.',
            'company_id.exists'            => 'La cadena seleccionada no existe en nuestros registros.',

            // BRANCH
            'branch.required_if'       => 'Por favor, ingrese su sucursal.',
            'branch.prohibited_unless' => 'La sucursal solo aplica para usuarios tipo dependiente.',
            'branch.string'            => 'El campo sucursal debe ser un texto válido.',
            'branch.min'               => 'El campo sucursal debe tener al menos 3 caracteres.',
            'branch.max'               => 'El campo sucursal no puede tener más de 255 caracteres.',

            // LINEA
            'line_id.required_if'       => 'Por favor, seleccione una línea de medicamentos.',
            'line_id.prohibited_unless' => 'El campo línea solo aplica para usuarios tipo doctor.',
            'line_id.integer'           => 'La línea seleccionada no es válida.',
            'line_id.exists'            => 'La línea seleccionada no existe en nuestros registros.',

            // COLEGIADO
            'colegiado.required_if'       => 'Por favor, ingrese su número de colegiado.',
            'colegiado.prohibited_unless' => 'El número de colegiado solo aplica para usuarios tipo doctor.',
            'colegiado.string'            => 'El número de colegiado debe ser un texto válido.',
            'colegiado.min'               => 'El número de colegiado debe tener al menos 2 caracteres.',
            'colegiado.max'               => 'El número de colegiado no puede tener más de 20 caracteres.',
            'colegiado.unique'            => 'Ya existe un usuario registrado con este número de colegiado.',

            // ACCEPTED TERMS VERSION
            'accepted_terms_version.required' => 'Debe aceptar los términos y condiciones.',
            'accepted_terms_version.string'   => 'La versión de términos aceptados debe ser un texto válido.',
            'accepted_terms_version.max'      => 'La versión de términos aceptados no puede tener más de 20 caracteres.',
        ];
    }
}
