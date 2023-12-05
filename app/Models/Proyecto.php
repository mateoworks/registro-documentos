<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = [
        'carrera_id', 'tipo', 'nombre'
    ];

    protected $allowIncluded = ['carrera'];
    protected $allowFilter = ['nombre'];
    protected $allowSort = ['nombre'];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}
