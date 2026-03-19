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

        th {
            cursor: pointer;
            user-select: none;
        }

        th:hover {
            background-color: #006064;
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
        <h1>Gestión de Hoteles</h1>

        <table id="tablaHoteles">
            <thead>
                <tr>
                    <th onclick="ordenarTabla(0)">Nombre</th>
                    <th onclick="ordenarTabla(1)">Teléfono</th>
                    <th onclick="ordenarTabla(2)">Dirección</th>
                    <th onclick="ordenarTabla(3)">Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hoteles as $hotel)
                    <tr>
                        <td>{{ $hotel->nombre }}</td>
                        <td>{{ $hotel->telefono }}</td>
                        <td>{{ $hotel->direccion }}</td>
                        <td>{{ $hotel->categoria }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script>
        function ordenarTabla(n) {
            var tabla, filas, cambiando, i, x, y, deberiaCambiar, dir, conteoCambios = 0;
            tabla = document.getElementById("tablaHoteles");
            cambiando = true;
            dir = "asc";

            while (cambiando) {
                cambiando = false;
                filas = tabla.rows;

                for (i = 1; i < (filas.length - 1); i++) {
                    deberiaCambiar = false;

                    x = filas[i].getElementsByTagName("TD")[n];
                    y = filas[i + 1].getElementsByTagName("TD")[n];

                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            deberiaCambiar = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            deberiaCambiar = true;
                            break;
                        }
                    }
                }

                if (deberiaCambiar) {
                    filas[i].parentNode.insertBefore(filas[i + 1], filas[i]);
                    cambiando = true;
                    conteoCambios++;
                } else {
                    if (conteoCambios == 0 && dir == "asc") {
                        dir = "desc";
                        cambiando = true;
                    }
                }
            }
        }
    </script>
@endpush
