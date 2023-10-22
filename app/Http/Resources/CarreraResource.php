<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarreraResource extends JsonResource
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
            'departamento_id' => $this->departamento_id,
            'nombre' => $this->nombre,
            'escudo' => $this->getEscudo(),
            'clave' => $this->clave,
            'color' => $this->color,
            'abrev' => $this->abrev,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'departamento' => $this->whenLoaded('departamento'),
            'estudiantes' => EstudianteResource::collection($this->whenLoaded('estudiantes')),
        ];
    }
}
