<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntregaResource extends JsonResource
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
            'estudiante' => new EstudianteResource($this->whenLoaded('estudiante')),
            'documento' => new DocumentoResource($this->whenLoaded('documento')),
            'documento_id' => $this->documento_id,
            'estudiante_id' => $this->estudiante_id,
            'url_documento' => $this->getDocumento(),
            'fecha_entrega' => $this->fecha_entrega,
            'estado' => $this->estado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
