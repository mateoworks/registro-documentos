<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
        $empresaId = $this->route('empresa'); // Asegura que obtenga el ID de la empresa en la ruta

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
            'asesor_externo' => 'nullable|string|max:255',
            'asesor_externo_puesto' => 'nullable|string|max:255',
            'nombre_firmara' => 'nullable|string|max:255',
            'nombre_firmara_puesto' => 'nullable|string|max:255',
        ];
    }
}
