<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{
    use HasFactory;

    protected $table = 'residencias';

    protected $fillable = [
        'estudiante_id',
        'area_id',
        'periodo_id',
        'asesor_interno_id',
        'proyecto_id',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function asesorInterno()
    {
        return $this->belongsTo(AsesorInterno::class, 'asesor_interno_id', 'id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'id');
    }
}
