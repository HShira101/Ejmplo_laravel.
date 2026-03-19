<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'rut';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'rut',
        'nombre_completo',
        'telefono',
        'correo',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'rut_cliente', 'rut');
    }
}
