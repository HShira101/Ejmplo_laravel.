<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reserva;
use App\Models\Hotel;
use App\Models\Habitacion;
use App\Models\Cliente;
use App\Models\Agencia;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['habitacion', 'cliente', 'agencia'])->get();
        $hoteles = Hotel::all();
        $habitaciones = Habitacion::all();
        $clientes = Cliente::all();
        $agencias = Agencia::all();

        return view('Reservas', compact('reservas', 'hoteles', 'habitaciones', 'clientes', 'agencias'));
    }

    public function store(Request $request)
    {
        if ($request->fecha_ini >= $request->fecha_termino) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Error: La fecha de término debe ser estrictamente posterior a la fecha de inicio.'], 422);
            }
            return redirect('/Reservas')->with('error', 'Error: La fecha de término debe ser estrictamente posterior a la fecha de inicio.');
        }

        // Validar solapamiento de fechas
        $solapadas = Reserva::where('id_habitacion', $request->id_habitacion)
            ->where('fecha_ini', '<', $request->fecha_termino)
            ->where('fecha_termino', '>', $request->fecha_ini)
            ->exists();

        if ($solapadas) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Error: La habitación seleccionada ya se encuentra reservada en ese rango de fechas.'], 422);
            }
            return redirect('/Reservas')->with('error', 'Error: La habitación seleccionada ya se encuentra reservada en ese rango de fechas.');
        }

        Reserva::create([
            'id_habitacion' => $request->id_habitacion,
            'rut_cliente' => $request->rut_cliente,
            'fecha_ini' => $request->fecha_ini,
            'fecha_termino' => $request->fecha_termino,
            'id_agencia' => $request->id_agencia,
            'check_in' => false,
            'observaciones' => [],
        ]);

        return redirect('/Reservas');
    }

    public function checkIn($codigo)
    {
        $reserva = Reserva::findOrFail($codigo);
        $reserva->check_in = true;
        $reserva->save();

        // Al hacer check-in, la habitación asociada inmediatamente pasa a estar "en_uso"
        if ($reserva->id_habitacion) {
            $habitacion = Habitacion::find($reserva->id_habitacion);
            if ($habitacion) {
                $habitacion->en_uso = true;
                $habitacion->save();
            }
        }

        return redirect('/Reservas');
    }
}
