<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory, ApiTrait;
    protected $fillable = [
        'nombre',
        'asesor_externo',
        'asesor_externo_puesto',
        'nombre_firmara',
        'nombre_firmara_puesto',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
