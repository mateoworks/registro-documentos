<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesorInterno extends Model
{
    use HasFactory, ApiTrait;
    protected $table = 'asesor_interno';
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'titulo',
    ];
}
