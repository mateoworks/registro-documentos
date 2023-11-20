<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DocumentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre_documento' => $this->nombre_documento,
            'abrev_nombre' => $this->abrev_nombre,
            'entrega_estudiante' => $this->entrega_estudiante,
            'descripcion' => $this->descripcion,
            'fecha_limite' => Carbon::parse($this->fecha_limite)->format('Y-m-d'),
            'url_formato' => $this->getFormato(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
