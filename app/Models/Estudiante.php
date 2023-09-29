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

    protected $allowIncluded = ['user', 'carrera', 'empresas', 'periodos', 'proyectosRelacionados'];
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
            ->withPivot(['actividad', 'proyecto_id', 'periodo_id'])
            ->withTimestamps();
    }

    public function periodos(): BelongsToMany
    {
        return $this->belongsToMany(Periodo::class, 'empresa_estudiante', 'estudiante_id', 'periodo_id')
            ->distinct()
            ->withTimestamps();
    }

    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    public function proyectosRelacionados()
    {
        return $this->belongsToMany(Proyecto::class, 'empresa_estudiante', 'estudiante_id', 'proyecto_id')
            ->wherePivot('actividad', '=', 'proyecto')
            ->withPivot(['actividad', 'empresa_id', 'periodo_id'])
            ->withTimestamps();
    }

    public function estregas()
    {
        return $this->belongsToMany(Entrega::class);
    }
}
