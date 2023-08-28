<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaEstudiante extends Model
{
    use HasFactory;
    protected $table = 'empresa_estudiante';
    protected $fillable = [
        'empresa_id', 'estudiante_id', 'periodo_id', 'actividad',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
}
