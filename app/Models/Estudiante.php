<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudiante extends Model
{
    use HasFactory, HasUuids, ApiTrait;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'periodo_id', 'carrera_id', 'nombre', 'apellidos', 'numero_control',
        'domicilio', 'email', 'seguridad_social', 'no_seguridad_social', 'ciudad', 'telefono',
    ];

    protected $allowIncluded = ['user', 'carrera', 'empresas', 'periodos'];
    protected $allowFilter = [
        'nombre', 'apellidos', 'numero_control',
        'domicilio', 'email', 'telefono', 'carrera_id',
    ];
    protected $allowSort = ['nombre', 'apellidos',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function empresas(): BelongsToMany
    {
        return $this->belongsToMany(Empresa::class, 'empresa_estudiante')
            ->withPivot(['actividad', 'proyecto', 'periodo_id'])
            ->withTimestamps();
    }

    public function periodosActivos()
    {
        return $this->hasMany(Periodo::class, 'empresa_estudiante', 'estudiante_id', 'periodo_id')
            ->where('activo', true)
            ->withPivot('proyecto', 'actividad');
    }

    public function periodos()
    {
        return $this->belongsToMany(Periodo::class, 'empresa_estudiante', 'estudiante_id', 'periodo_id')
            ->withPivot('proyecto', 'actividad')
            ->withTimestamps();
    }

    public function estregas()
    {
        return $this->belongsToMany(Entrega::class);
    }
}
