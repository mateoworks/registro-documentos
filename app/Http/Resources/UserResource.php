<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'id' => $this->id,
            'img_portada' => $this->getPortada(),
            'img_foto' => $this->getFoto(),
            'name' => $this->name,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}
