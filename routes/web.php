<?php

# Aquí se manejan las URL de las vistas.
#
# La sigueinte función Toma la URL y la asocia a la vista
# en la carpeta Views. (esta no usa controladores).
# Route::get('/Campo_URL', function () {
#   Aquí puede ir código PHP, para la vista, mejor práctica es usar controladores.
#    return view('Campo_VISTA');
# });
#
# El siguiente comando toma una URL y la asocia al controlador
# en la carpeta Controllers, en este caso el controlador entrega la vista.
#. (esta si usa controladores).
# Route::get('/Campo_URL', [\App\Http\Controllers\CAMPO_CONTROLADOR::class, 'index']);
#
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $habitacionesEnUso = \App\Models\Habitacion::where('en_uso', true)->count();
    $habitacionesTotal = \App\Models\Habitacion::count();
    $reservasActivas = \App\Models\Reserva::where('check_in', true)->count();
    $hoy = now()->toDateString();
    $reservasSinEjecutar = \App\Models\Reserva::where('check_in', false)
        ->whereDate('fecha_ini', '<=', $hoy)
        ->whereDate('fecha_termino', '>=', $hoy)
        ->count();

    // Traer las reservas que contengan observaciones, ordenadas por fecha más reciente
    $reservasConNotas = \App\Models\Reserva::with(['habitacion.hotel', 'cliente', 'agencia'])
        ->whereNotNull('observaciones')
        ->where('observaciones', '!=', '[]')
        ->orderBy('fecha_ini', 'desc')
        ->get();

    return view('Inicio', compact('habitacionesEnUso', 'habitacionesTotal', 'reservasActivas', 'reservasSinEjecutar', 'reservasConNotas'));
});

Route::get('/Hoteles', [\App\Http\Controllers\HotelController::class, 'index']);

Route::get('/Reservas', [\App\Http\Controllers\ReservaController::class, 'index']);
Route::post('/Reservas', [\App\Http\Controllers\ReservaController::class, 'store']);
Route::patch('/Reservas/{codigo}/checkin', [\App\Http\Controllers\ReservaController::class, 'checkIn']);

Route::get('/Habitaciones', [\App\Http\Controllers\HabitacionController::class, 'index']);

Route::get('/Clientes', [\App\Http\Controllers\ClienteController::class, 'index']);

Route::get('/Agencias', [\App\Http\Controllers\AgenciaController::class, 'index']);
