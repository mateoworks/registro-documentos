<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidenteRequest extends FormRequest
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
            'estudiante_id' => 'required|unique:residencias,estudiante_id',
            'area_id' => 'required|exists:areas,id',
            'periodo_id' => 'nullable|exists:periodos,id',
            'asesor_interno_id' => 'nullable|exists:asesor_interno,id',
            'proyecto_id' => 'nullable|exists:proyectos,id',
        ];
    }
}
