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
}
