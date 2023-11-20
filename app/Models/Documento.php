<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Documento extends Model
{
    use HasFactory, SoftDeletes, ApiTrait;
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_documento',
        'abrev_nombre',
        'entrega_estudiante',
        'descripcion',
        'fecha_limite',
        'url_formato'
    ];

    protected $allowIncluded = ['entregas'];
    protected $allowFilter = ['nombre_documento'];
    protected $allowSort = ['nombre_documento'];
    protected $casts = [
        'fecha_limite' => 'date',
    ];
    public static function boot()
    {
        parent::boot();

        static::forceDeleted(function ($documento) {
            if ($documento->url_formato) {
                if (Storage::disk('public')->exists($documento->url_formato))
                    Storage::disk('public')->delete($documento->url_formato);
            }
        });
    }

    public function setFechaLimiteAttribute($value)
    {
        $this->attributes['fecha_limite'] = Carbon::parse($value);
    }

    public function entregas()
    {
        return $this->belongsToMany(Entrega::class);
    }

    public function getFormato()
    {
        if ($this->url_formato) {
            if (Storage::disk('public')->exists($this->url_formato))
                return Storage::disk('public')->url($this->url_formato);
        } else
            return null;
    }
}
