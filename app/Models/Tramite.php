<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tramite extends Model
{
    use HasFactory;

    protected $table = 'tramite';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'disponible'
    ];

    public function turnos()
    {
        return $this->hasMany(Turno::class, 'tramite_id');
    }
}
