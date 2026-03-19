@extends('layouts.app')

@push('css')
    <style>
        /* Estilos específicos para la tabla de reservas */
        .tabla-contenedor {
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #00838f;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background-color: #00838f;
            color: white;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        /* Efecto cebra para las filas de la tabla */
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #b2ebf2;
            /* Cian muy clarito al pasar el mouse por la fila */
        }
    </style>
@endpush

@section('content')
    <div class="tabla-contenedor">
        <h1>Gestión de Reservas</h1>

        <table>
            <thead>
                <tr>
                    <th>Habitación</th>
                    <th>Hotel</th>
                    <th>Cliente</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha de Término</th>
                    <th>Código</th>
                    <th>Agencia</th>
                </tr>
            </thead>
            <tbody>
                <!-- Datos de ejemplos estáticos (luego se llenarán con MariaDB) -->
                <tr>
                    <td>101</td>
                    <td>Hotel Paraíso</td>
                    <td>Juan Pérez</td>
                    <td>2026-03-20</td>
                    <td>2026-03-25</td>
                    <td>1</td>
                    <td>Booking.com</td>
                </tr>
                <tr>
                    <td>205</td>
                    <td>Hotel Costa Azul</td>
                    <td>María López</td>
                    <td>2026-03-22</td>
                    <td>2026-03-28</td>
                    <td>2</td>
                    <td>Expedia</td>
                </tr>
                <tr>
                    <td>Suite 3A</td>
                    <td>Hotel Montaña</td>
                    <td>Carlos Gómez</td>
                    <td>2026-04-01</td>
                    <td>2026-04-05</td>
                    <td>3</td>
                    <td>Directa (Recepción)</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
