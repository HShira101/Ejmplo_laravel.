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

        .btn-agregar {
            background-color: #00838f;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-agregar:hover {
            background-color: #006064;
        }

        .btn-editar {
            background-color: #ff9800;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn-editar:hover {
            background-color: #e68a00;
        }

        .btn-checkin {
            background-color: #4caf50;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            transition: background-color 0.3s;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-checkin:hover {
            background-color: #388e3c;
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

        /* Efecto cebra para los grupos de la tabla */
        .grupo-reserva:nth-child(even) .fila-reserva {
            background-color: #f2f2f2;
        }

        .fila-reserva:hover {
            background-color: #b2ebf2;
        }

        .fila-reserva {
            cursor: pointer;
        }

        .fila-observaciones {
            background-color: #e0f7fa;
        }

        .fila-observaciones td {
            padding: 15px;
            border-left: 4px solid #00838f;
        }
    </style>
@endpush

@section('content')
    <div class="tabla-contenedor">
        <h1>Gestión de Reservas</h1>

        <div style="margin-bottom: 20px;">
            <button class="btn-agregar" onclick="abrirModal('modalReserva')">+ Agregar Reserva</button>
        </div>

        <table id="tablaReservas">
            <thead>
                <tr>
                    <th onclick="ordenarTabla(0)">Habitación</th>
                    <th onclick="ordenarTabla(1)">Hotel</th>
                    <th onclick="ordenarTabla(2)">Cliente</th>
                    <th onclick="ordenarTabla(3)">Fecha Inicio</th>
                    <th onclick="ordenarTabla(4)">Fecha de Término</th>
                    <th onclick="ordenarTabla(5)">Código</th>
                    <th onclick="ordenarTabla(6)">Agencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            @foreach ($reservas as $reserva)
                <tbody class="grupo-reserva">
                    <tr class="fila-reserva" onclick="toggleObservaciones('obs-{{ $reserva->codigo }}')">
                        <td>{{ $reserva->habitacion ? $reserva->habitacion->numero : $reserva->id_habitacion }}</td>
                        <td>{{ $reserva->habitacion && $reserva->habitacion->hotel ? $reserva->habitacion->hotel->nombre : 'N/A' }}
                        </td>
                        <td>{{ $reserva->cliente ? $reserva->cliente->nombre_completo : $reserva->rut_cliente }}</td>
                        <td>{{ $reserva->fecha_ini ? $reserva->fecha_ini->format('Y-m-d') : 'No agendado' }}</td>
                        <td>{{ $reserva->fecha_termino ? $reserva->fecha_termino->format('Y-m-d') : 'No expira' }}</td>
                        <td>{{ $reserva->codigo }}</td>
                        <td>{{ $reserva->agencia ? $reserva->agencia->nombre : 'Directa' }}</td>
                        <td style="text-align: center;">
                            @if(!$reserva->check_in)
                                @php
                                    $hoy = now()->startOfDay();
                                    $esFechaValida = false;
                                    if ($reserva->fecha_ini && $reserva->fecha_termino) {
                                        $esFechaValida = $hoy->betweenIncluded($reserva->fecha_ini, $reserva->fecha_termino);
                                    }
                                @endphp
                                <form action="/Reservas/{{ $reserva->codigo }}/checkin" method="POST" id="form-checkin-{{ $reserva->codigo }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn-checkin" onclick="event.stopPropagation(); intentarCheckIn({{ $reserva->codigo }}, {{ $esFechaValida ? 'true' : 'false' }})" title="Confirmar Check-In">&#x2714;</button>
                                </form>
                            @endif
                            <a href="#" class="btn-editar" title="Editar Reserva" onclick="event.stopPropagation();">&#x270E;</a>
                        </td>
                    </tr>
                    <tr id="obs-{{ $reserva->codigo }}" class="fila-observaciones" style="display: none;">
                        <td colspan="8">
                            @if (empty($reserva->observaciones))
                                <em>Sin observaciones</em>
                            @else
                                <ul>
                                    @foreach ($reserva->observaciones as $obs)
                                        <li><strong>{{ ucfirst($obs['tipo']) ?? 'Nota' }}:</strong>
                                            {{ $obs['detalle'] ?? '' }}; <strong>{{ $obs['estado'] ?? '-' }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <!-- Modal para Agregar Reserva -->
    <x-modal id="modalReserva" titulo="Agregar Reserva">
        <form id="formNuevaReserva" action="/Reservas" method="POST">
            @csrf
            
            <div id="errorAviso" style="display: none; background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #f5c6cb;"></div>
            
            <div class="form-group">
                <label for="hotel_id">Hotel:</label>
                <select id="hotel_id" class="form-control" onchange="actualizarHabitaciones()">
                    <option value="">-- Selecciona un Hotel --</option>
                    @foreach($hoteles as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_habitacion">Habitación:</label>
                <select name="id_habitacion" id="id_habitacion" class="form-control" required>
                    <option value="">-- Selecciona un Hotel primero --</option>
                </select>
            </div>

            <div class="form-group">
                <label for="rut_cliente">Cliente:</label>
                <select name="rut_cliente" id="rut_cliente" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->rut }}">{{ $cliente->rut == 0 ? 'n/a (Reserva Anónima)' : $cliente->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_ini">Fecha de Inicio:</label>
                <input type="date" name="fecha_ini" id="fecha_ini" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha_termino">Fecha de Término:</label>
                <input type="date" name="fecha_termino" id="fecha_termino" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="id_agencia">Agencia:</label>
                <select name="id_agencia" id="id_agencia" class="form-control" required>
                    @foreach($agencias as $agencia)
                        <option value="{{ $agencia->id }}">{{ $agencia->id == 0 ? 'n/a (Agencia Directa)' : $agencia->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div style="text-align: right; margin-top: 25px;">
                <button type="button" class="btn-cancelar" onclick="cerrarModal('modalReserva')">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar Reserva</button>
            </div>
        </form>
    </x-modal>
@endsection

@push('js')
    <script>
        const habitacionesData = @json($habitaciones);

        function actualizarHabitaciones() {
            const hotelId = document.getElementById('hotel_id').value;
            const selectHab = document.getElementById('id_habitacion');
            
            selectHab.innerHTML = '<option value="">-- Selecciona una Habitación --</option>';
            
            if(hotelId) {
                const habitacionesHotel = habitacionesData.filter(h => h.hotel_id == hotelId);
                habitacionesHotel.forEach(h => {
                    selectHab.innerHTML += `<option value="${h.id}">${h.numero} - ${h.tipo} (${h.categoria})</option>`;
                });
            } else {
                selectHab.innerHTML = '<option value="">-- Selecciona un Hotel primero --</option>';
            }
        }

        document.getElementById('formNuevaReserva').addEventListener('submit', function(e) {
            e.preventDefault();
            let form = this;
            let formData = new FormData(form);
            let errorDiv = document.getElementById('errorAviso');
            
            errorDiv.style.display = 'none';
            
            fetch('/Reservas', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else if (response.status === 422) {
                    return response.json();
                } else {
                    console.error('Error en el servidor de guardado');
                }
            })
            .then(data => {
                if (data && data.error) {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = '<strong>⚠️ ' + data.error + '</strong>';
                }
            })
            .catch(error => console.error(error));
        });

        function toggleObservaciones(id) {
            var fila = document.getElementById(id);
            if (fila.style.display === "none" || fila.style.display === "") {
                fila.style.display = "table-row";
            } else {
                fila.style.display = "none";
            }
        }

        function intentarCheckIn(codigo, esValido) {
            if (!esValido) {
                alert("No se puede hacer el check-in, fuera de fecha");
            } else {
                alert("Check-in confirmado");
                document.getElementById('form-checkin-' + codigo).submit();
            }
        }

        function ordenarTabla(n) {
            var tabla, grupos, cambiando, i, x, y, deberiaCambiar, dir, conteoCambios = 0;
            tabla = document.getElementById("tablaReservas");
            cambiando = true;
            dir = "asc";

            while (cambiando) {
                cambiando = false;
                grupos = document.getElementsByClassName("grupo-reserva");

                for (i = 0; i < (grupos.length - 1); i++) {
                    deberiaCambiar = false;

                    x = grupos[i].getElementsByTagName("TR")[0].getElementsByTagName("TD")[n];
                    y = grupos[i + 1].getElementsByTagName("TR")[0].getElementsByTagName("TD")[n];

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
                    // Mueve el bloque <tbody class="grupo-reserva"> completo con ambas filas
                    grupos[i].parentNode.insertBefore(grupos[i + 1], grupos[i]);
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
