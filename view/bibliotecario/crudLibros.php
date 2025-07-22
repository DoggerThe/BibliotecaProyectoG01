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
                <h2 class="title-Ingreso">Ingresar Nuevo Libro</h2>
                <div class="contenedor-formulario">
                    <form id="InsertarNuevoLibro">
                        <div class="grupo-Libro">
                            <label for="isbn">ISBN:</label>
                            <input type="text" id="isbn" name="isbn" placeholder="978-0140442892" maxlength="14" pattern="^\d{3}-\d{1,10}$" required>
                        </div>

                        <div class="grupo-Libro">
                            <label for="titulo">Título:</label>
                            <input type="text" id="titulo" name="titulo" placeholder="Cien años de soledad" required>
                        </div>

                        <div class="form-group">
                            <label for="genero" class="form-label fw-semibold">Genero:</label>
                            <select name="genero" id="genero" class="form-select" required>
                                <option value="" disabled selected>Seleccione una opción</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" min="1" placeholder="1" required>
                        </div>

                        <div class="form-group">
                            <label for="autor">Autor:</label>
                            <input type="text" id="autor" name="autor" placeholder="Daniel Martinez" required>
                        </div>

                        <div class="form-group">
                            <label for="editorial">Editorial:</label>
                            <input type="text" id="editorial" name="editorial" placeholder="Historia" required>
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
                                <th>ISBN</th>
                                <th>Titulo</th>
                                <th>Genero</th>
                                <th>Autor</th>
                                <th>Editorial</th>
                                <th>Cantidad</th>
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
                <input type="hidden" name="id" id="edit-id">

                <label for="edit-isbn">ISBN:</label>
                <input type="text" id="edit-isbn" name="isbn" disabled>

                <label for="edit-titulo">Título:</label>
                <input type="text" id="edit-titulo" name="titulo" required>

                <label for="genero" class="form-label fw-semibold">Genero:</label>
                <select name="genero" id="generoModal" class="form-select" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                </select>

                <label for="edit-autor">Autor:</label>
                <input type="text" id="edit-autor" name="autor" required>

                <label for="edit-editorial">Editorial:</label>
                <input type="text" id="edit-editorial" name="editorial" required>

                <label for="edit-cantidad">Cantidad:</label>
                <input type="number" id="edit-cantidad" name="cantidad" required>

                <button onclick="EditarLibro()" class="btn_guardar">Actualizar</button>
            </form>
        </div>
    </div>

</body>
<script src="/BibliotecaProyectoG01/assets/js/crudLibros.js"></script>

</html>