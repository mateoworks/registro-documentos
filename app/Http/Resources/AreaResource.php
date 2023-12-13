<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
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
            'asesor_externo' => $this->asesor_externo,
            'asesor_externo_puesto' => $this->asesor_externo_puesto,
            'nombre_firmara' => $this->nombre_firmara,
            'nombre_firmara_puesto' => $this->nombre_firmara_puesto,
            'empresa_id' => $this->empresa_id,
            'empresa' => new EmpresaResource($this->whenLoaded('empresa')),
        ];
    }
}
