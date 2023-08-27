<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory, HasUuids, ApiTrait;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $allowFilter = ['nombre', 'opcion'];
    protected $allowSort = ['nombre', 'opcion'];

    protected $fillable = [
        'estudiante_id', 'nombre', 'opcion',
    ];
}
