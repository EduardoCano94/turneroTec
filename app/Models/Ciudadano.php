<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudadano extends Model
{
    use HasFactory;

    protected $table = 'ciudadano';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'clave_identificacion',
    ];


    public function turnos()
    {
        return $this->hasMany(Turno::class, 'id_ciudadano');
    }
}
