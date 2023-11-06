<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarreraRequest extends FormRequest
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
            'departamento_id' => 'required|exists:departamentos,id',
            'nombre' => 'required|string|max:255',
            'escudo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'clave' => 'required|string|max:255',
            'color' => 'nullable',
            'abrev' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'departamento_id.required' => 'El campo Departamento es obligatorio.',
            'departamento_id.exists' => 'El Departamento seleccionado no es válido.',
            'nombre.required' => 'El nombre de la carrera es requerido.',
            'nombre.string' => 'El nombre de la carrera debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la carrera no puede tener más de :max caracteres.',
            'escudo.image' => 'El escudo de la carrera debe ser una imagen válida.',
            'escudo.mimes' => 'El escudo de la carrera debe ser una imagen en formato JPEG, PNG, JPG o GIF.',
            'escudo.max' => 'El escudo de la carrera no puede ser mayor de :max kilobytes.',
            'clave.required' => 'La clave de la carrera es requerida.',
            'clave.string' => 'La clave de la carrera debe ser una cadena de texto.',
            'clave.max' => 'La clave de la carrera no puede tener más de :max caracteres.',
            'color' => 'El campo Color no es válido.',
            'abrev' => 'El campo Abreviatura no es válido.',
        ];
    }
}
