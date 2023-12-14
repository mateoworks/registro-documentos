<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
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
            'giro' => 'required|string|max:255',
            'rfc' => 'nullable|string|max:255',
            'domicilio' => 'required|string|max:255',
            'colonia' => 'required|string|max:255',
            'cp' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'mision' => 'nullable|string',
            'titular' => 'required|string|max:255',
            'titular_puesto' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la empresa es requerido.',
            'nombre.string' => 'El nombre de la empresa debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la empresa no puede tener más de :max caracteres.',
            'giro.required' => 'El giro de la empresa es requerido.',
            'giro.string' => 'El giro de la empresa debe ser una cadena de texto.',
            'giro.max' => 'El giro de la empresa no puede tener más de :max caracteres.',
            'rfc.string' => 'El RFC de la empresa debe ser una cadena de texto.',
            'rfc.max' => 'El RFC de la empresa no puede tener más de :max caracteres.',
            'domicilio.required' => 'El domicilio de la empresa es requerido.',
            'domicilio.string' => 'El domicilio de la empresa debe ser una cadena de texto.',
            'domicilio.max' => 'El domicilio de la empresa no puede tener más de :max caracteres.',
            'colonia.required' => 'La colonia de la empresa es requerida.',
            'colonia.string' => 'La colonia de la empresa debe ser una cadena de texto.',
            'colonia.max' => 'La colonia de la empresa no puede tener más de :max caracteres.',
            'cp.string' => 'El código postal de la empresa debe ser una cadena de texto.',
            'cp.max' => 'El código postal de la empresa no puede tener más de :max caracteres.',
            'ciudad.string' => 'La ciudad de la empresa debe ser una cadena de texto.',
            'ciudad.max' => 'La ciudad de la empresa no puede tener más de :max caracteres.',
            'telefono.string' => 'El teléfono de la empresa debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono de la empresa no puede tener más de :max caracteres.',
            'mision.string' => 'La misión de la empresa debe ser una cadena de texto.',
            'titular.required' => 'El nombre del titular de la empresa es requerido.',
            'titular.string' => 'El nombre del titular de la empresa debe ser una cadena de texto.',
            'titular.max' => 'El nombre del titular de la empresa no puede tener más de :max caracteres.',
            'titular_puesto.required' => 'El puesto del titular de la empresa es requerido.',
            'titular_puesto.string' => 'El puesto del titular de la empresa debe ser una cadena de texto.',
            'titular_puesto.max' => 'El puesto del titular de la empresa no puede tener más de :max caracteres.',
            'asesor_externo.string' => 'El asesor externo de la empresa debe ser una cadena de texto.',
            'asesor_externo.max' => 'El asesor externo de la empresa no puede tener más de :max caracteres.',
            'asesor_externo_puesto.string' => 'El puesto del asesor externo de la empresa debe ser una cadena de texto.',
            'asesor_externo_puesto.max' => 'El puesto del asesor externo de la empresa no puede tener más de :max caracteres.',
            'nombre_firmara.string' => 'El nombre de quien firmará debe ser una cadena de texto.',
            'nombre_firmara.max' => 'El nombre de quien firmará no puede tener más de :max caracteres.',
            'nombre_firmara_puesto.string' => 'El puesto de quien firmará debe ser una cadena de texto.',
            'nombre_firmara_puesto.max' => 'El puesto de quien firmará no puede tener más de :max caracteres.',
        ];
    }
}
