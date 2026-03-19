<!DOCTYPE html>
<html lang="es">

{{--
Esta es una plantilla que se usará para vistas hijas.

@stack('css/js') proporciona un espacio para agregar estilos o
scrips para las vistas hijas, se agregan o sobrescriben estilos
dependiendo de la situación.

@yield('content') es el contenido que se agregará a la plantilla por
vistas hijas, se puede usar para agregar contenido dinámico a la plantilla.
el campo 'content' puede tener cualquier nombre, pero debe ser el mismo
en la vista hija. Como buena práctica mejor usar 'content' para evitar
confusiones.

 --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración hotelera</title>

    <style>
        /* Fondo azul cian para toda la página */
        body {
            background-color: #e0f7fa;
            /* un tono cian suave */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Estilos de la barra de navegación */
        nav {
            background-color: #00838f;
            /* un tono cian oscuro para contrastar */
            padding: 15px;
            display: flex;
            /* Flexbox permite centrar y espaciar fácilmente */
            justify-content: center;
            /* Centra los elementos */
            gap: 30px;
            /* Crea espacio entre cada enlace */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Estilos de los enlaces en la navegación */
        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        /* Efecto al pasar el mouse por los enlaces */
        nav a:hover {
            background-color: #00bcd4;
        }

        /* Contenedor principal para dar un poco de margen al contenido */
        main {
            padding: 40px;
            text-align: center;
        }

        /* Estilos globales para Modales Reutilizables */
        .modal-base {
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semi-transparente */
            display: flex; /* Flex para centrar */
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 0;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
            text-align: left;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e0f7fa;
            background-color: #f8fcfc;
            padding: 15px 25px;
            border-radius: 8px 8px 0 0;
        }

        .modal-header h2 {
            margin: 0;
            color: #00838f;
            font-size: 20px;
        }

        .cerrar-modal {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .cerrar-modal:hover {
            color: #333;
        }
        
        .modal-body {
            padding: 25px;
        }

        /* Estilos globales de Formularios para Modales */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .btn-guardar, .btn-cancelar {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-guardar {
            background-color: #4caf50;
            color: white;
            margin-left: 10px;
        }

        .btn-guardar:hover {
            background-color: #45a049;
        }

        .btn-cancelar {
            background-color: #f44336;
            color: white;
        }

        .btn-cancelar:hover {
            background-color: #da190b;
        }
    </style>

    <!-- Espacio para estilos específicos de cada vista -->
    @stack('css')
</head>

<body>
    <nav>
        <a href="/">Inicio</a>
        <a href="/Reservas">Reservas</a>
        <a href="/Hoteles">Hoteles</a>
        <a href="/Habitaciones">Habitaciones</a>
        <a href="/Clientes">Clientes</a>
        <a href="/Agencias">Agencias</a>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Funciones globales de Modales -->
    <script>
        function abrirModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function cerrarModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        // Cerrar al hacer clic fuera
        window.onclick = function(event) {
            if (event.target.classList.contains('modal-base')) {
                event.target.style.display = "none";
            }
        }
    </script>

    <!-- Espacio para scripts específicos de cada vista -->
    @stack('js')
</body>

</html>
