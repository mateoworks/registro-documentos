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
            'genero' => 'nullable',
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
    public function messages()
    {
        return [
            'carrera_id.required' => 'El campo Carrera es obligatorio.',
            'carrera_id.exists' => 'La Carrera seleccionada no es válida.',
            'nombre.required' => 'El nombre del estudiante es requerido.',
            'nombre.string' => 'El nombre del estudiante debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del estudiante no puede tener más de :max caracteres.',
            'apellidos.required' => 'Los apellidos del estudiante son requeridos.',
            'apellidos.string' => 'Los apellidos del estudiante deben ser una cadena de texto.',
            'apellidos.max' => 'Los apellidos del estudiante no pueden tener más de :max caracteres.',
            'numero_control.required' => 'El número de control del estudiante es requerido.',
            'numero_control.unique' => 'El número de control ingresado ya está en uso.',
            'numero_control.max' => 'El número de control del estudiante no puede tener más de :max caracteres.',
            'domicilio.string' => 'El domicilio del estudiante debe ser una cadena de texto.',
            'domicilio.max' => 'El domicilio del estudiante no puede tener más de :max caracteres.',
            'email.required' => 'El correo electrónico del estudiante es requerido.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ingresado ya está en uso.',
            'email.max' => 'El correo electrónico del estudiante no puede tener más de :max caracteres.',
            'seguridad_social.string' => 'El número de seguro social debe ser una cadena de texto.',
            'seguridad_social.max' => 'El número de seguro social no puede tener más de :max caracteres.',
            'no_seguridad_social.string' => 'El número de seguro social debe ser una cadena de texto.',
            'no_seguridad_social.max' => 'El número de seguro social no puede tener más de :max caracteres.',
            'ciudad.string' => 'La ciudad del estudiante debe ser una cadena de texto.',
            'ciudad.max' => 'La ciudad del estudiante no puede tener más de :max caracteres.',
            'telefono.string' => 'El teléfono del estudiante debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono del estudiante no puede tener más de :max caracteres.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.max' => 'La contraseña del estudiante no puede tener más de :max caracteres.',
            'url_foto.image' => 'La foto debe ser una imagen válida.',
            'url_foto.mimes' => 'La foto debe ser en formato JPEG, PNG, JPG o GIF.',
            'url_foto.max' => 'La foto no puede ser mayor de :max kilobytes.',
        ];
    }
}
