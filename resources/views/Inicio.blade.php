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
                <div class="numero">15</div>
            </div>

            <div class="tarjeta" style="border-top-color: #ff9800;">
                <h3>Reservas Activas</h3>
                <div class="numero">8</div>
            </div>

            <div class="tarjeta" style="border-top-color: #4caf50;">
                <h3>Habitaciones Libres</h3>
                <div class="numero">22</div>
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
                        <th>Agencia</th>
                        <th>Observación Especial</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>María López Gómez</td>
                        <td>205</td>
                        <td>Expedia</td>
                        <td><span class="badge-alerta">Importante</span> Cuna extra requerida, el vuelo llega de madrugada.
                        </td>
                    </tr>
                    <tr>
                        <td>Carlos Rodríguez</td>
                        <td>Suite 3A</td>
                        <td>Despegar</td>
                        <td><span class="badge-alerta">Importante</span> Alergia severa a frutos secos (Avisado al
                            restaurante).</td>
                    </tr>
                    <tr>
                        <td>Juan Pérez Silva</td>
                        <td>101</td>
                        <td>Booking.com</td>
                        <td><span class="badge-alerta">Importante</span> Requiere factura impresa a nombre de empresa al
                            salir.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
