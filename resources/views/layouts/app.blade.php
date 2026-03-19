<!DOCTYPE html>
<html lang="es">

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

    <!-- Espacio para scripts específicos de cada vista -->
    @stack('js')
</body>

</html>
