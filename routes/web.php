<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Inicio');
});

Route::get('/Hoteles', [\App\Http\Controllers\HotelController::class, 'index']);

Route::get('/Reservas', function () {
    return view('Reservas');
});

Route::get('/Habitaciones', [\App\Http\Controllers\HabitacionController::class, 'index']);

Route::get('/Clientes', function () {
    return view('Clientes');
});

Route::get('/Agencias', function () {
    return view('Agencias');
});
