<?php

namespace App\Http\Resources;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeriodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $includedEstudiantes = $request->has('included') && $request->included === 'estudiantes';
        $data = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_termino' => $this->fecha_termino,
            'activo' => $this->activo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'estudiantes' => EstudianteResource::collection($this->whenLoaded('estudiantes')),
        ];
        return $data;
    }
}
