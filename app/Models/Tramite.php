<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    protected $table = 'tramites';
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'costo',
        'tiempo_estimado',
        'activo',
    ];

    protected $casts = [
        'costo' => 'decimal:2',
        'activo' => 'boolean',
    ];

    // Relación: Un trámite puede tener muchos turnos
    public function turnos()
    {
        return $this->hasMany(Turno::class, 'tramite_id');
    }
}