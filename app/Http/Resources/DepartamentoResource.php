<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentoResource extends JsonResource
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
            'nombre' => $this->nombre,
            'nombre_titular' => $this->nombre_titular,
            'apellidos_titular' => $this->apellidos_titular,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Agrega la relación con carreras si es necesario
            'carreras' => CarreraResource::collection($this->whenLoaded('carreras')), // Ajusta esto según tu relación
        ];
    }
}
