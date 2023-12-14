<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Estudiante extends Model
{
    use HasFactory, HasUuids, ApiTrait, SoftDeletes;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'periodo_id', 'carrera_id', 'nombre', 'apellidos', 'genero', 'numero_control',
        'domicilio', 'email', 'seguridad_social', 'no_seguridad_social', 'ciudad', 'telefono',
    ];

    protected $allowIncluded = ['user', 'carrera', 'empresa', 'periodo', 'asesorInterno', 'proyecto'];
    protected $allowFilter = [
        'nombre', 'apellidos', 'numero_control',
        'domicilio', 'email', 'telefono', 'carrera_id',
    ];
    protected $allowSort = ['nombre', 'apellidos',];

    public static function boot()
    {
        parent::boot();

        static::forceDeleted(function ($estudiante) {
            if ($estudiante->user->url_foto) {
                if (Storage::disk('public')->exists($estudiante->user->url_foto))
                    Storage::disk('public')->delete($estudiante->user->url_foto);
            }
            if ($estudiante->url_portada) {
                if (Storage::disk('public')->exists($estudiante->user->url_portada))
                    Storage::disk('public')->delete($estudiante->user->url_portada);
            }
            $estudiante->user->forceDelete();
        });
    }

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

    //Residencias relacion

    public function empresa()
    {

        return $this->hasOneThrough(Area::class, Residencia::class, 'estudiante_id', 'id', 'id', 'area_id');
    }
    public function residencia()
    {
        return $this->belongsTo(Residencia::class);
    }

    public function periodo()
    {
        return $this->hasOneThrough(Periodo::class, Residencia::class, 'estudiante_id', 'id', 'id', 'periodo_id');
    }

    public function asesorInterno()
    {
        return $this->hasOneThrough(AsesorInterno::class, Residencia::class, 'estudiante_id', 'id', 'id', 'asesor_interno_id');
    }

    public function proyecto()
    {
        return $this->hasOneThrough(Proyecto::class, Residencia::class, 'estudiante_id', 'id', 'id', 'proyecto_id');
    }
}
