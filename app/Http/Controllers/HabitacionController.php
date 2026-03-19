<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class HabitacionController extends Controller
{
    // Función que carga la pantalla principal de habitaciones
    public function index()
    {
        // Busca todas las habitaciones en la base de datos
        $habitaciones = Habitacion::all();
        
        // Retorna la vista y "lanza" la variable hacia la vista
        return view('Habitaciones', compact('habitaciones'));
    }
}
