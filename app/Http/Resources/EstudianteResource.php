<?php

namespace App\Http\Resources;

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
            'numero_control' => $this->numero_control,
            'domicilio' => $this->domicilio,
            'email' => $this->email,
            'seguridad_social' => $this->seguridad_social,
            'no_seguridad_social' => $this->no_seguridad_social,
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'carrera' => $this->whenLoaded('carrera'),
            'proyectos' => ProyectoResource::collection($this->whenLoaded('proyectos')),
            'empresas' => EmpresaResource::collection($this->whenLoaded('empresas')),
        ];
    }
}
