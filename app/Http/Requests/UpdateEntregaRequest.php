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
    public function messages()
    {
        return [
            'estudiante_id.required' => 'El campo Estudiante es obligatorio.',
            'estudiante_id.uuid' => 'El identificador del estudiante no es válido.',
            'estudiante_id.exists' => 'El estudiante seleccionado no es válido.',
            'documento_id.required' => 'El campo Documento es obligatorio.',
            'documento_id.exists' => 'El documento seleccionado no es válido.',
            'url_documento.string' => 'La URL del documento debe ser una cadena de texto.',
            'url_documento.max' => 'La URL del documento no puede tener más de :max caracteres.',
            'fecha_entrega.required' => 'La fecha de entrega es requerida.',
            'fecha_entrega.date' => 'La fecha de entrega debe ser una fecha válida.',
            'estado.required' => 'El campo Estado es obligatorio.',
            'estado.boolean' => 'El campo Estado debe ser verdadero o falso.',
        ];
    }
}
