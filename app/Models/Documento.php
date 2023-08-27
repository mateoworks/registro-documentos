<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use HasFactory, SoftDeletes, ApiTrait;
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_documento',
    ];

    protected $allowIncluded = ['entregas'];
    protected $allowFilter = ['nombre_documento'];
    protected $allowSort = ['nombre_documento'];

    public function entregas()
    {
        return $this->belongsToMany(Entrega::class);
    }
}
