<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use HasFactory, SoftDeletes, ApiTrait;

    protected $fillable = [
        'nombre', 'nombre_titular', 'apellidos_titular',
    ];

    protected $allowIncluded = ['carreras'];
    protected $allowFilter = ['nombre', 'apellidos_titular', 'nombre_titular'];
    protected $allowSort = ['nombre', 'apellidos_titular', 'nombre_titular'];

    public function carreras()
    {
        return $this->hasMany(Carrera::class);
    }
}
