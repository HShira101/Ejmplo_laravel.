<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'id_habitacion',
        'rut_cliente',
        'fecha_ini',
        'fecha_termino',
        'id_agencia',
        'observaciones',
        'check_in',
    ];

    protected $casts = [
        'observaciones' => 'array',
        'fecha_ini' => 'date',
        'fecha_termino' => 'date',
        'check_in' => 'boolean',
    ];

    public function habitacion() // Asume que el modelo Habitacion existe o se creará.
    {
        return $this->belongsTo(Habitacion::class, 'id_habitacion');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'rut_cliente', 'rut');
    }

    public function agencia()
    {
        return $this->belongsTo(Agencia::class, 'id_agencia');
    }
}
