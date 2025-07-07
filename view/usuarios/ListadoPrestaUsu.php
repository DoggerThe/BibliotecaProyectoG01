<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecua Librería</title>
    <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/InicioGeneral.css">
    <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/SolicPrestBibli.css">
</head>

<body>
    <!-- Contenedor principal de la vista del usuario bibliotecario -->
    <div class="bibliotecario-container">
        <!-- Encabezado con bienvenida, botón de cerrar sesión y acceso al perfil -->
        <?php include __DIR__."/../layout/layoutUsuario.php";?>
        <!-- Contenedor principal de contenido -->
        <div class="container-General">
            <div class="Container-Tabla">
                <h1>Lista de prestamos</h1>
                <!-- Tabla donde se mostrará la información de los préstamos -->
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Num. Prestamo</th>
                            <th>Libro</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Cuerpo de la tabla que será llenado dinámicamente mediante JavaScript (AJAX) -->
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            const idUsuario = <?php echo isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : '0'?>;
        </script>
        <script src="/BibliotecaProyectoG01/assets/js/ListadoPrestaUsu.js"></script>
    </div>
</body>

</html>