<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentoRequest extends FormRequest
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
        $documentoId = $this->route('documento');

        return [
            'nombre_documento' => 'required|string|max:255',
            'abrev_nombre' => 'nullable|string|max:255',
            'fecha_limite' => 'required|date',
            'url_formato' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png'
        ];
    }
    public function messages()
    {
        return [
            'nombre_documento.required' => 'El nombre del documento es requerido.',
            'nombre_documento.string' => 'El nombre del documento debe ser una cadena de texto.',
            'nombre_documento.max' => 'El nombre del documento no puede tener más de :max caracteres.',
            'abrev_nombre.string' => 'La abreviatura del nombre debe ser una cadena de texto.',
            'abrev_nombre.max' => 'La abreviatura del nombre no puede tener más de :max caracteres.',
            'fecha_limite.required' => 'La fecha límite del documento es requerida.',
            'fecha_limite.date' => 'La fecha límite del documento debe ser una fecha válida.',
            'url_formato.file' => 'El formato del documento debe ser un archivo válido.',
            'url_formato.mimes' => 'El formato del documento debe ser de tipo PDF, DOC, DOCX, JPG, JPEG o PNG.',
            'url_formato.max' => 'El formato del documento no puede ser mayor de :max kilobytes.',
        ];
    }
}
