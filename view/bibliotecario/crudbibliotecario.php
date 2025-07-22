<!DOCTYPE html>
<html lang="es">

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
                <h2 class="title-Ingreso">Ingresar Nuevo Bibliotecario</h2>
                <div class="contenedor-formulario">
                    <form id="InsertarNuevoUser">
                        <div class="grupo-Libro">
                            <label for="cedula">cedula:</label>
                            <input type="text" id="cedula" placeholder="01234567989" maxlength="10" required>
                        </div>

                        <div class="grupo-Libro">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" placeholder="Juan" required>
                        </div>

                        <div class="grupo-Libro">
                            <label for="apellido_paterno">Apellido:</label>
                            <input type="text" id="apellido_paterno" placeholder="Plaza" required>
                        </div>

                        <div class="grupo-Libro">
                            <label for="apellido_materno">Apellido materno (opcional):</label>
                            <input type="text" id="apellido_materno" placeholder="Plaza" required>
                        </div>

                        <div class="grupo-Libro">
                            <label for="correo">Correo:</label>
                            <input type="email" id="correo" placeholder="ajem@ejem.com" required>
                        </div>

                        <div class="form-group">
                            <label for="direccion">Direccion:</label>
                            <input type="text" id="direccion" placeholder="El cerro" required>
                        </div>

                        <div class="form-group">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" id="contrasena" name="contrasena" required>
                        </div>

                        <button type="submit" class="btn_guardar">Guardar Libro</button>
                    </form>
                </div>
            </div>

            <div class="columna-derecha">
                <h2 class="title-Ingreso">Lista de prestamos</h2>
                <div class="Container-Tabla">
                    <table id="tablaLibros">
                        <thead>
                            <tr>
                                <th>cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Apellido materno</th>
                                <th>Correo</th>
                                <th>Direccion</th>
                                <th>Accion</th>
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
                <label for="edit-cedula">cedula:</label>
                <input type="text" id="edit-cedula" disabled>

                <label for="edit-Nombre">Nombre:</label>
                <input type="text" id="edit-Nombre" required>

                <label for="edit-Apellido">Apellido:</label>
                <input type="text" id="edit-Apellido" required>

                <label for="edit-ApellidoMaterno">Apellido Materno:</label>
                <input type="text" id="edit-ApellidoMaterno" >

                <label for="edit-correo">Correo:</label>
                <input type="email" id="edit-correo" required>

                <label for="edit-Direccion">Direccion:</label>
                <input type="text" id="edit-Direccion" required>


                <button onclick="EditarUsuario()" class="btn_guardar">Actualizar</button>
            </form>
        </div>
    </div>

</body>
<script>
    const rol = 2;
</script>
<script src="/BibliotecaProyectoG01/assets/js/crudPersonas.js"></script>

</html>