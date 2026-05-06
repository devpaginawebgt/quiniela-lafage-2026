<?php

namespace App\Http\Requests\Auth;

use App\Models\Country;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !$this->user()->completed_info;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Tu información ya está completa.');
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ((int) $this->user()->user_type_id) {
            1       => $this->rulesForDependiente(),
            2       => $this->rulesForDoctor(),
            default => [],
        };
    }

    private function rulesForDependiente(): array
    {
        $userId = $this->user()->id;

        return [
            'company_id'       => ['required', 'integer', 'exists:companies,id'],
            'branch'           => ['required', 'string', 'min:3', 'max:255'],
            'numero_documento' => ['required', 'string', 'min:6', 'max:20', Rule::unique('users', 'numero_documento')->ignore($userId)],
            'line_id'          => ['prohibited'],
            'colegiado'        => ['prohibited'],
        ];
    }

    private function rulesForDoctor(): array
    {
        $userId = $this->user()->id;

        return [
            'company_id'       => ['prohibited'],
            'branch'           => ['prohibited'],
            'numero_documento' => ['required', 'string', 'min:6', 'max:20', Rule::unique('users', 'numero_documento')->ignore($userId)],
            'line_id'          => ['required', 'integer', 'exists:lines,id'],
            'colegiado'        => ['required', 'string', 'min:2', 'max:20', Rule::unique('users', 'colegiado')->ignore($userId)],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($validator->errors()->has('numero_documento')) {
                return;
            }

            $country = Country::find($this->user()->pais_id);

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
            'numero_documento.required' => 'Por favor, ingrese su número de documento.',
            'numero_documento.string'   => 'El número de documento debe ser un texto válido.',
            'numero_documento.min'      => 'El número de documento debe tener al menos 6 caracteres.',
            'numero_documento.max'      => 'El número de documento no puede tener más de 20 caracteres.',
            'numero_documento.unique'   => 'Ya existe un usuario registrado con este número de documento.',

            'colegiado.required'   => 'Por favor, ingrese su número de colegiado.',
            'colegiado.prohibited' => 'El número de colegiado solo aplica para usuarios tipo doctor.',
            'colegiado.string'     => 'El número de colegiado debe ser un texto válido.',
            'colegiado.min'        => 'El número de colegiado debe tener al menos 2 caracteres.',
            'colegiado.max'        => 'El número de colegiado no puede tener más de 20 caracteres.',
            'colegiado.unique'     => 'Ya existe un usuario registrado con este número de colegiado.',

            'company_id.required'    => 'Por favor, seleccione la cadena de farmacias para la cuál labora.',
            'company_id.prohibited'  => 'El campo cadena solo aplica para usuarios tipo dependiente.',
            'company_id.integer'     => 'La cadena seleccionada no es válida.',
            'company_id.exists'      => 'La cadena seleccionada no existe en nuestros registros.',

            'branch.required'    => 'Por favor, ingrese su sucursal.',
            'branch.prohibited'  => 'La sucursal solo aplica para usuarios tipo dependiente.',
            'branch.string'      => 'El campo sucursal debe ser un texto válido.',
            'branch.min'         => 'El campo sucursal debe tener al menos 3 caracteres.',
            'branch.max'         => 'El campo sucursal no puede tener más de 255 caracteres.',

            'line_id.required'    => 'Por favor, seleccione una línea de medicamentos.',
            'line_id.prohibited'  => 'El campo línea solo aplica para usuarios tipo doctor.',
            'line_id.integer'     => 'La línea seleccionada no es válida.',
            'line_id.exists'      => 'La línea seleccionada no existe en nuestros registros.',
        ];
    }
}
