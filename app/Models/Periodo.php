<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo extends Model
{
    use HasFactory, SoftDeletes, ApiTrait;

    protected $fillable = [
        'nombre', 'fecha_inicio', 'fecha_termino',
    ];

    protected $allowIncluded = ['empresaEstudiantes'];
    protected $allowFilter = ['nombre'];
    protected $allowSort = ['fecha_inicio', 'fecha_termino', 'nombre'];

    public function empresaEstudiantes(): HasMany
    {
        return $this->hasMany(EmpresaEstudiante::class, 'periodo_id');
    }
}
