@extends('layouts.app')

@push('css')
    <style>
        /* Estilos específicos para la tabla de habitaciones */
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

        /* Agregamos el cursor estilo "mano" para indicar que se puede hacer clic, y evitamos que el texto se seleccione */
        th {
            cursor: pointer;
            user-select: none;
        }

        th:hover {
            background-color: #006064;
            /* Un tono un poquito más oscuro al pasar el mouse por el encabezado */
        }

        /* Efecto cebra para las filas de la tabla */
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
        <h1>Gestión de Habitaciones</h1>

        <!-- Le ponemos un ID a la tabla para que JavaScript la encuentre fácilmente -->
        <table id="tablaHabitaciones">
            <thead>
                <tr>
                    <!-- Al hacer clic (onclick) enviamos el número de columna que queremos ordenar (0, 1, 2, 3) -->
                    <th onclick="ordenarTabla(0)">Número</th>
                    <th onclick="ordenarTabla(1)">Hotel</th>
                    <th onclick="ordenarTabla(2)">Tipo</th>
                    <th onclick="ordenarTabla(3)">Categoría</th>
                    <th onclick="ordenarTabla(4)">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($habitaciones as $habitacion)
                    <tr>
                        <td>{{ $habitacion->numero }}</td>
                        <td>{{ $habitacion->hotel->nombre }}</td>
                        <td>{{ $habitacion->tipo }}</td>
                        <td>{{ $habitacion->categoria }}</td>
                        <td>{{ $habitacion->en_uso ? '⚠ En Uso' : '✔ Libre' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<!-- Aquí viene la magia: Inyectamos el JavaScript exclusivo para esta vista -->
@push('js')
    <script>
        function ordenarTabla(n) {
            var tabla, filas, cambiando, i, x, y, deberiaCambiar, dir, conteoCambios = 0;
            tabla = document.getElementById("tablaHabitaciones");
            cambiando = true;
            // Configurar la dirección inicial a ascendente ("asc"):
            dir = "asc";

            // Repetir el ciclo hasta que todas las filas estén en su lugar correcto:
            while (cambiando) {
                cambiando = false;
                filas = tabla.rows;

                // Recorrer todas las filas (saltándose la [0] que es el Encabezado <th>)
                for (i = 1; i < (filas.length - 1); i++) {
                    deberiaCambiar = false;

                    // Tomar la celda actual y la siguiente que están en la misma columna "n"
                    x = filas[i].getElementsByTagName("TD")[n];
                    y = filas[i + 1].getElementsByTagName("TD")[n];

                    // Comprobar si de verdad deberían intercambiarse basándose en la dirección (asc o desc)
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
                    // Intercambiar mágicamente en la pantalla (HTML) y marcar para seguir revisando:
                    filas[i].parentNode.insertBefore(filas[i + 1], filas[i]);
                    cambiando = true;
                    conteoCambios++;
                } else {
                    // Si dimos una vuelta entera sin cambios y estábamos en "asc", significa que ya
                    // estaba ordenada así. Entonces la daremos vuelta a "desc" (Descendente)
                    if (conteoCambios == 0 && dir == "asc") {
                        dir = "desc";
                        cambiando = true;
                    }
                }
            }
        }
    </script>
@endpush
