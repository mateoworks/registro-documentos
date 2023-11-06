<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeriodoRequest extends FormRequest
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
        $periodoId = $this->route('periodo');
        return [
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after_or_equal:fecha_inicio',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del período es requerido.',
            'nombre.string' => 'El nombre del período debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del período no puede tener más de :max caracteres.',
            'fecha_inicio.required' => 'La fecha de inicio del período es requerida.',
            'fecha_inicio.date' => 'La fecha de inicio del período debe ser una fecha válida.',
            'fecha_termino.required' => 'La fecha de término del período es requerida.',
            'fecha_termino.date' => 'La fecha de término del período debe ser una fecha válida.',
            'fecha_termino.after_or_equal' => 'La fecha de término debe ser igual o posterior a la fecha de inicio del período.',
        ];
    }
}
