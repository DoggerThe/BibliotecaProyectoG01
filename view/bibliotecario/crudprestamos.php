<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecua Librería - Bibliotecario</title>
    <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/InicioGeneral.css">
    <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/cruds.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
    <div class="bibliotecario-container">

        <?php include __DIR__ . '/../layout/layoutBibliotecario.php'; ?>
        <!-- Tabla que mostrará la lista de libros recuperados desde la base de datos -->
        <main class="main-content">
            <div class="columna-izquierda">
                <h2 class="title-Ingreso">Ingresar Nuevo Prestamo</h2>
                <div class="contenedor-formulario">
                    <form id="InsertarNuevoPrestamo">
                        <div class="grupo-Libro">
                            <label for="id_bibliotecario">cod. bibliotecario:</label>
                            <input type="text" id="id_bibliotecario" name="id_bibliotecario" placeholder="1" required>
                        </div>

                        <div class="grupo-Libro">
                            <label for="id_usuario">cod. usuario:</label>
                            <input type="text" id="id_usuario" name="id_usuario" placeholder="1" required>
                        </div>

                        <div class="form-group">
                            <label for="id_libro">cod. libro:</label>
                            <input type="text" id="id_libro" name="id_libro" placeholder="1" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_solicitud">fecha solicitud:</label>
                            <input type="date" id="fecha_solicitud" name="fecha_solicitud" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio_prestamo">fecha inicio:</label>
                            <input type="date" id="fecha_inicio_prestamo" name="fecha_inicio_prestamo" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_fin_prestamo">fecha fin:</label>
                            <input type="date" id="fecha_fin_prestamo" name="fecha_fin_prestamo" required>
                        </div>

                        <button type="submit" class="btn_guardar">Guardar Libro</button>
                    </form>
                </div>
            </div>

            <div class="columna-derecha">
                <h2 class="title-Ingreso">Lista de libros</h2>
                <div class="Container-Tabla">
                    <table id="tablaLibros">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>cedula_usuario</th>
                                <th>libro</th>
                                <th>fecha solicitud</th>
                                <th>fecha inicio</th>
                                <th>fecha fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    <!--  <script src="/BibliotecaProyectoG01/assets/js/busquedaLibros.js"></script>-->
    <div id="modalEditar" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h3>Editar</h3>
            <form id="formEditarLibro">
                <label for="edit-id">ID:</label>
                <input type="text" id="edit-id" disabled>

                <label for="edit-cedula">Cedula:</label>
                <input type="text" id="edit-cedula" name="titulo" disabled>

                <label for="edit-libro">libro:</label>
                <input type="text" id="edit-libro" name="autor" disabled>

                <label for="edit-fechaSoli">fecha Solicitado:</label>
                <input type="date" id="edit-fechaSoli" required>

                <label for="edit-fechaInic">fecha Inicio:</label>
                <input type="date" id="edit-fechaInic" required>

                <label for="edit-fechaFin">fecha Fin:</label>
                <input type="date" id="edit-fechaFin" required>


                <button onclick="EditarPrestamo()" class="btn_guardar">Actualizar</button>
            </form>
        </div>
    </div>

</body>
<script src="/BibliotecaProyectoG01/assets/js/crudPrestamo.js"></script>

</html>