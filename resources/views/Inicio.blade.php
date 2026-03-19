{{--
@ Extends toma la plantilla que se encuentra en layauts
y la inserta como esqueleto para lo demás, en este caso toma
la plantilla app.blade.app, basta con el nombre antes de .blade.php

@push('css/js') la plantilla layaut, otorga un espacio para agregar mas estilos o JS.
sobreescribe o agrega estilos a la que ya se encuentra en la plantilla.
Ejemplo:
@push('css')
    <style>
        /* Aquí va el código CSS que se insertará en la plantilla app.blade.php */
    </style>
@endpush

@section('content') es el contenido que se agregará a la plantilla, ver layaut
para saber donde se insertará.    
 --}}
@extends('layouts.app')

@push('css')
    <style>
        .dashboard-contenedor {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        h1 {
            color: #00838f;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Grid para las tarjetas superiores (Reporte de Habitaciones) */
        .tarjetas-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        /* Estilo general de las tarjetas "Widget" */
        .tarjeta {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-top: 5px solid #00838f;
            /* Borde superior distintivo */
        }

        .tarjeta h3 {
            margin: 0;
            color: #555;
            font-size: 18px;
        }

        .tarjeta .numero {
            font-size: 45px;
            font-weight: bold;
            color: #00838f;
            margin-top: 10px;
        }

        /* Sección inferior para tablas/listas */
        .seccion-observaciones {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .seccion-observaciones h2 {
            color: #00838f;
            border-bottom: 2px solid #e0f7fa;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Estilo de la tabla interna del dashboard */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        .badge-alerta {
            background-color: #ff9800;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-contenedor">

        <!-- SECCIÓN 1: Reporte rápido de habitaciones -->
        <div class="tarjetas-grid">
            <div class="tarjeta">
                <h3>Habitaciones en Uso</h3>
                <div class="numero">{{ $habitacionesEnUso }} / {{ $habitacionesTotal }}</div>
            </div>

            <div class="tarjeta" style="border-top-color: #ff9800;">
                <h3>Reservas Activas</h3>
                <div class="numero">{{ $reservasActivas }}</div>
            </div>

            <div class="tarjeta" style="border-top-color: #4caf50;">
                <h3>Reservas Sin Check-in</h3>
                <div class="numero">{{ $reservasSinEjecutar }}</div>
            </div>
        </div>

        <!-- SECCIÓN 2: Observaciones Especiales -->
        <div class="seccion-observaciones">
            <h2>⚠️ Reservas con Notas Pendientes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Habitación</th>
                        <th>Observación Especial</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasConNotas as $reserva)
                        @foreach ($reserva->observaciones as $obs)
                            <tr>
                                <td>{{ $reserva->cliente ? $reserva->cliente->nombre_completo : 'Anónimo' }}</td>
                                <td>{{ $reserva->habitacion ? 'Nº ' . $reserva->habitacion->numero . ($reserva->habitacion->hotel ? ' (' . $reserva->habitacion->hotel->nombre . ')' : '') : 'N/A' }}
                                </td>
                                <td>
                                    <span class="badge-alerta">{{ ucfirst($obs['tipo'] ?? 'Nota') }}</span>
                                    {{ $obs['detalle'] ?? '' }}
                                    <strong>({{ ucfirst($obs['estado'] ?? 'N/A') }})</strong>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #777; padding: 20px;">No hay reservaciones
                                con notas importantes en este momento.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
