<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ],
            'password' => [
                Rule::requiredIf(function () {
                    return $this->isMethod('post');
                }),
            ],
            'url_foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],
            'rol' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre del usuario es requerido.',
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ingresado ya está en uso.',
            'password.required' => 'La contraseña es requerida.',
            'url_foto.image' => 'La foto debe ser una imagen válida.',
            'url_foto.mimes' => 'La foto debe ser en formato JPEG, PNG, JPG o GIF.',
            'url_foto.max' => 'La foto no puede ser mayor de :max kilobytes.',
            'rol.required' => 'El rol del usuario es requerido.',
        ];
    }
}
