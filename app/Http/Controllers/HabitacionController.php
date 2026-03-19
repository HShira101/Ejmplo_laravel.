<?php

// Los controladores permiten manejar la lógica de las vistas.
// de este modo las vistas se mantienen limpias y ordenadas.
// Las URL le piden al controlador las peticiones (vistas, peticiones a base de datos, etc).
// y en base a eso el controlador entrega la vista o la respuesta.

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
