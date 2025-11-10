<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'disponible',
        'name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getNameAttribute()
{
    return $this->nombre . ' ' . $this->apellido;
}

// Mutador para cuando se asigne 'name'
public function setNameAttribute($value)
{
    $partes = explode(' ', $value, 2);
    $this->attributes['nombre'] = $partes[0];
    $this->attributes['apellido'] = $partes[1] ?? '';
}
}
