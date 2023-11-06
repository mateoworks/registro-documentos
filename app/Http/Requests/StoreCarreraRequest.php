<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarreraRequest extends FormRequest
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
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo Nombre no puede tener más de :max caracteres.',
            'escudo.image' => 'El campo Escudo debe ser una imagen válida.',
            'escudo.mimes' => 'El campo Escudo debe ser una imagen en formato JPEG, PNG, JPG o GIF.',
            'escudo.max' => 'El campo Escudo no puede ser mayor de :max kilobytes.',
            'clave.required' => 'El campo Clave es obligatorio.',
            'clave.string' => 'El campo Clave debe ser una cadena de texto.',
            'clave.max' => 'El campo Clave no puede tener más de :max caracteres.',
        ];
    }
}
