<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntregaRequest extends FormRequest
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
        $entregaId = $this->route('entrega'); // Asegura que obtenga el ID de la entrega en la ruta

        return [
            'estudiante_id' => 'required|uuid|exists:estudiantes,id',
            'documento_id' => 'required|exists:documentos,id',
            'url_documento' => 'nullable|string|max:255',
            'fecha_entrega' => 'required|date',
            'estado' => 'required|boolean',
        ];
    }
}
