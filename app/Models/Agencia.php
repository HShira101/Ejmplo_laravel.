<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    protected $table = 'agencias';

    protected $fillable = [
        'nombre',
        'telefono',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_agencia');
    }
}
