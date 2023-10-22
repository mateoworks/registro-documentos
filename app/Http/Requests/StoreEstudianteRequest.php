<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstudianteRequest extends FormRequest
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
            'carrera_id' => 'required|exists:carreras,id',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'numero_control' => 'required|string|unique:estudiantes,numero_control|max:255',
            'domicilio' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'seguridad_social' => 'nullable|string|max:255',
            'no_seguridad_social' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'url_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
