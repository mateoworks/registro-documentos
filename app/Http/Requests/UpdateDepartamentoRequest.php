<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartamentoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'nombre_titular' => 'required|string|max:255',
            'apellidos_titular' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del departamento es requerido.',
            'nombre.string' => 'El nombre del departamento debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del departamento no puede tener más de :max caracteres.',
            'nombre_titular.required' => 'El nombre del titular del departamento es requerido.',
            'nombre_titular.string' => 'El nombre del titular del departamento debe ser una cadena de texto.',
            'nombre_titular.max' => 'El nombre del titular del departamento no puede tener más de :max caracteres.',
            'apellidos_titular.required' => 'Los apellidos del titular del departamento son requeridos.',
            'apellidos_titular.string' => 'Los apellidos del titular del departamento deben ser una cadena de texto.',
            'apellidos_titular.max' => 'Los apellidos del titular del departamento no pueden tener más de :max caracteres.',
        ];
    }
}
