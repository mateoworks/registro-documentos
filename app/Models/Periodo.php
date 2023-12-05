<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo extends Model
{
    use HasFactory, SoftDeletes, ApiTrait;

    protected $fillable = [
        'nombre', 'fecha_inicio', 'fecha_termino', 'activo',
    ];

    protected $allowIncluded = ['empresaEstudiantes', 'estudiantes'];
    protected $allowFilter = ['nombre'];
    protected $allowSort = ['fecha_inicio', 'fecha_termino', 'nombre'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($periodo) {
            if ($periodo->activo) {
                static::where('activo', true)->update(['activo' => false]);
            }
        });
    }

    public function empresaEstudiantes(): HasMany
    {
        return $this->hasMany(EmpresaEstudiante::class, 'periodo_id');
    }

    /* public function estudiantes(): BelongsToMany
    {
        return $this->belongsToMany(Estudiante::class, 'empresa_estudiante')
            ->withPivot(['actividad', 'proyecto_id'])
            ->withTimestamps();
    } */
    /* public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'empresa_estudiante', 'periodo_id', 'estudiante_id')
            ->withPivot('actividad');
    } */

    public function empresas(): BelongsToMany
    {
        return $this->belongsToMany(Empresa::class, 'empresa_estudiante')
            ->withPivot('actividad', 'periodo_id')
            ->withTimestamps();
    }

    public function residencias()
    {
        return $this->hasMany(Residencia::class, 'periodo_id', 'id');
    }
    public function estudiantes()
    {
        return $this->hasManyThrough(
            Estudiante::class,
            Residencia::class,
            'periodo_id', // Clave foránea en la tabla Residencia
            'id', // Clave primaria en la tabla Estudiante
            'id', // Clave local en la tabla Periodo
            'estudiante_id' // Clave foránea en la tabla Residencia que apunta a Estudiante
        );
    }
}
