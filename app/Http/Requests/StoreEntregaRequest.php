<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntregaRequest extends FormRequest
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
            'estudiante_id' => 'required|uuid|exists:estudiantes,id',
            'documento_id' => 'required|exists:documentos,id',
            'url_documento' => 'nullable|file|mimes:pdf,doc,docx',
            'fecha_entrega' => 'required|date',
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
            'url_documento.file' => 'El archivo de documento debe ser un archivo válido.',
            'url_documento.mimes' => 'El archivo de documento debe ser de tipo PDF, DOC o DOCX.',
            'fecha_entrega.required' => 'La fecha de entrega es requerida.',
            'fecha_entrega.date' => 'La fecha de entrega debe ser una fecha válida.',
        ];
    }
}
