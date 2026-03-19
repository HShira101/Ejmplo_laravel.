<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    // Permitimos que estas columnas se puedan rellenar masivamente
    protected $fillable = ['numero', 'hotel_id', 'tipo', 'categoria'];
}
