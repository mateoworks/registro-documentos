<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes, HasUuids, ApiTrait;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nombre', 'giro', 'rfc', 'domicilio', 'colonia', 'cp',
        'ciudad', 'telefono', 'mision', 'titular', 'titular_puesto',
        'asesor_externo', 'asesor_externo_puesto', 'nombre_firmara',
        'nombre_firmara_puesto',
    ];

    protected $allowIncluded = ['estudiantes'];
    protected $allowFilter = ['nombre', 'giro', 'ciudad', 'titular'];
    protected $allowSort = ['nombre', 'giro', 'ciudad', 'titular'];

    public function estudiantes(): BelongsToMany
    {
        return $this->belongsToMany(Estudiante::class, 'empresa_estudiante')
            ->withPivot('actividad', 'periodo_id')
            ->withTimestamps();
    }
}
