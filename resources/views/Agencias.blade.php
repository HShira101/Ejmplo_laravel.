@extends('layouts.app')

@push('css')
    <style>
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

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #b2ebf2;
        }
    </style>
@endpush

@section('content')
    <div class="tabla-contenedor">
        <h1>Gestión de Agencias</h1>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Número de Reservas</th>
                </tr>
            </thead>
            <tbody>
                <!-- Datos de ejemplos estáticos -->
                <tr>
                    <td>Booking.com</td>
                    <td>+31 20 715 6890</td>
                    <td>145</td>
                </tr>
                <tr>
                    <td>Expedia</td>
                    <td>+1 800 397 3342</td>
                    <td>89</td>
                </tr>
                <tr>
                    <td>Despegar</td>
                    <td>+56 2 2938 1000</td>
                    <td>52</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
