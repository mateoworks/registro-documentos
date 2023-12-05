<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Carrera extends Model
{
    use HasFactory, SoftDeletes, ApiTrait;

    protected $fillable = [
        'departamento_id', 'nombre', 'escudo', 'clave', 'color', 'abrev'
    ];

    protected $allowIncluded = ['departamento', 'estudiantes'];
    protected $allowFilter = ['nombre'];
    protected $allowSort = ['nombre'];

    public static function boot()
    {
        parent::boot();

        static::forceDeleted(function ($carrera) {
            if ($carrera->escudo) {
                if (Storage::disk('public')->exists($carrera->escudo))
                    Storage::disk('public')->delete($carrera->escudo);
            }
        });
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'carrera_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
    public function getEscudo()
    {
        if ($this->escudo) {
            if (Storage::disk('public')->exists($this->escudo))
                return Storage::disk('public')->url($this->escudo);
        } else
            return null;
    }
}
