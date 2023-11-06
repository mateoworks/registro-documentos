<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($entrega) {
            if ($entrega->url_documento) {
                if (Storage::disk('public')->exists($entrega->url_documento))
                    Storage::disk('public')->delete($entrega->url_documento);
            }
        });
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function getDocumento()
    {
        if ($this->url_documento) {
            if (Storage::disk('public')->exists($this->url_documento))
                return Storage::disk('public')->url($this->url_documento);
        } else
            return null;
    }
}
