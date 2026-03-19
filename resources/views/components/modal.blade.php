{{--

Componente para modales reutilizables

@props(['id', 'titulo'])

--}}

<div id="{{ $id }}" class="modal-base" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>{{ $titulo }}</h2>
            <span class="cerrar-modal" onclick="cerrarModal('{{ $id }}')">&times;</span>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
    </div>
</div>
