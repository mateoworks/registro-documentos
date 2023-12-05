<?php

namespace App\Http\Resources;

use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstudianteResource extends JsonResource
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
            'user_id' => $this->user_id,
            'carrera_id' => $this->carrera_id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'genero' => $this->genero,
            'numero_control' => $this->numero_control,
            'domicilio' => $this->domicilio,
            'email' => $this->email,
            'seguridad_social' => $this->seguridad_social,
            'no_seguridad_social' => $this->no_seguridad_social,
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => UserResource::make($this->whenLoaded('user')),
            'carrera' => CarreraResource::make($this->whenLoaded('carrera')),
            'empresa' => EmpresaResource::make($this->whenLoaded('empresa')),
            'periodo' => PeriodoResource::make($this->whenLoaded('periodo')),
            'actividad' => $this->whenPivotLoaded('empresa_estudiante', function () {
                return $this->pivot->actividad;
            }),
        ];
    }
}
