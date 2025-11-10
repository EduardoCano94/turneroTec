<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turnos';
    
    protected $fillable = [
        'numero',
        'fecha',
        'descripcion',
        'estado',
        'id_ciudadano',
        'tramite_id', // ← Agregado
    ];

    // Relación: Un turno pertenece a un ciudadano
    public function ciudadano()
    {
        return $this->belongsTo(Ciudadano::class, 'id_ciudadano');
    }

    // Relación: Un turno pertenece a un trámite
    public function tramite()
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }
}