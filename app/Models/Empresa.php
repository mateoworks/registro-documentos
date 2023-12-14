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
    ];

    protected $allowIncluded = ['estudiantes', 'areas'];
    protected $allowFilter = ['nombre', 'giro', 'ciudad', 'titular'];
    protected $allowSort = ['nombre', 'giro', 'ciudad', 'titular'];

    public function areas()
    {
        return $this->hasMany(Area::class, 'empresa_id');
    }
}
