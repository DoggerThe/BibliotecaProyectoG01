<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecua Librería - Bibliotecario</title>
    <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/InicioGeneral.css">
    <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/SolicPrestBibli.css">
</head>

<body>
    <div class="bibliotecario-container">
        <?php include __DIR__.'/../layout/layoutBibliotecario.php';?>

        <!-- Contenedor general para la tabla de solicitudes -->
        <div class="container-General">
            <div class="Container-Tabla">
                <h1>Solicitudes de Préstamos</h1>
                <!-- Tabla con encabezado y una fila de ejemplo -->
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Id Prestamo</th>
                            <th>Usuario</th>
                            <th>Libro</th>
                            <th>Fecha de Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se generarán dinámicamente las filas de la tabla con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal emergente para mostrar detalles de una solicitud -->
        <div id="modal" class="modal" style="display:none;">
            <div class="modal-content">
                <!-- Botón para cerrar el modal -->
                <span class="close" onclick="cerrarModal()">&times;</span>
                <h2>Detalles del Préstamo</h2>
                <!-- Información detallada que se llenará dinámicamente con JavaScript -->
                <p><strong>Cedula del usuario:</strong> <span id="modalCedula"></span></p>
                <p><strong>Libro:</strong> <span id="modalLibro"></span></p>
                <p><strong>Fecha de Solicitud:</strong> <span id="modalFechaSolicitud"></span></p>
                <p><strong>Fecha de Inicio:</strong> <span id="modalFechaInicio"></span></p>
                <p><strong>Fecha de Fin:</strong> <span id="modalFechaFin"></span></p>
                <!-- Botón para confirmar la solicitud desde el modal -->
                <button onclick="cambiarEstado(1)">Confirmar Solicitud</button>
                <button style="background-color: red;" onclick="cambiarEstado(5)">Denegar Solicitud</button>
            </div>
        </div>
        <script> 
            const rolUsuario = <?php echo isset($_SESSION['rolUsuario']) ? $_SESSION['rolUsuario'] : '0'?>;
            const idUsuario = <?php echo isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : '0'?>; 
        </script>
        <script src="/BibliotecaProyectoG01/assets/js/listarSolicitudes.js"></script>
    </div>
</body>

</html>