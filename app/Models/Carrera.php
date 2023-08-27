<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrera extends Model
{
    use HasFactory, SoftDeletes, ApiTrait;

    protected $fillable = [
        'departamento_id', 'nombre', 'escudo', 'clave',
    ];

    protected $allowIncluded = ['departamento', 'estudiantes'];
    protected $allowFilter = ['nombre'];
    protected $allowSort = ['nombre'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
