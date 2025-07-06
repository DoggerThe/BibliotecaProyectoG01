<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(1); // 1 es el rol de usuario normal
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecua Librería</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioGeneral.css">
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/SolicPrestBibli.css">
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
            const idUsuario = <?php echo $_SESSION['usuario']['id']; ?>;
        </script>
        <script src="/SistemaBiblioteca/public/js/ListadoPrestaUsu.js"></script>
    </div>
</body>

</html>