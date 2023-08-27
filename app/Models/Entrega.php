<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory, HasUuids, ApiTrait;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'estudiante_id', 'documento_id', 'url_documento', 'fecha_entrega', 'estado',
    ];

    protected $allowIncluded = ['estudiante', 'documento'];
    protected $allowFilter = ['fecha_entrega'];
    protected $allowSort = ['fecha_entrega'];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
