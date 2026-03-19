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
        <h1>Gestión de Clientes</h1>

        <table>
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre Completo</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
                <!-- Datos de ejemplos estáticos -->
                <tr>
                    <td>12.345.678-9</td>
                    <td>Juan Pérez Silva</td>
                    <td>+56 9 1234 5678</td>
                    <td>juan.perez@ejemplo.com</td>
                </tr>
                <tr>
                    <td>18.765.432-1</td>
                    <td>María López Gómez</td>
                    <td>+56 9 9876 5432</td>
                    <td>m.lopez@ejemplo.com</td>
                </tr>
                <tr>
                    <td>9.876.543-K</td>
                    <td>Carlos Rodríguez</td>
                    <td>+56 9 5555 4444</td>
                    <td>carlos.rod@ejemplo.com</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
