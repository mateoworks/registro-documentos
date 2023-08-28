<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'giro' => $this->giro,
            'rfc' => $this->rfc,
            'domicilio' => $this->domicilio,
            'colonia' => $this->colonia,
            'cp' => $this->cp,
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'mision' => $this->mision,
            'titular' => $this->titular,
            'titular_puesto' => $this->titular_puesto,
            'asesor_externo' => $this->asesor_externo,
            'asesor_externo_puesto' => $this->asesor_externo_puesto,
            'nombre_firmara' => $this->nombre_firmara,
            'nombre_firmara_puesto' => $this->nombre_firmara_puesto,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'estudiantes' => EstudianteResource::collection($this->whenLoaded('estudiantes')),
            'actividad' => $this->whenPivotLoaded('empresa_estudiante', function () {
                return $this->pivot->actividad;
            }),
        ];
    }
}
