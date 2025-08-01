<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion </title>
    <!-- Enlace a la hoja de estilos personalizada para el formulario de login/registro -->
    <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/RegisInis.css">
</head>

<body>
    <div class="contenedor-principal">
        <!-- Columna izquierda con imagen decorativa -->
        <div class="columna-izquierda">
            <img src="/BibliotecaProyectoG01/assets/img/Biblioteca.jpeg" alt="Lámpara de biblioteca" class="imagen-decorativa">
        </div>
        <!-- Columna derecha con el formulario -->
        <div class="columna-derecha">
            <img src="/BibliotecaProyectoG01/assets/img/Logobiblioteca.png" alt="Logo Biblioteca" class="logo">
            <div class="contenedor-formulario">
                <h1>Biblioteca</h1>
                <form id="loginForm" method="POST" action="index.php?accion=procesarLogin">
                    <!-- Campo para ingresar la cédula del usuario -->
                    <div class="grupo-formulario">
                        <label for="usuario">Cédula</label>
                        <input type="text" id="usuario" name="usuario" placeholder="Cédula" maxlength="10" minlength="10" required>
                    </div>
                    <!-- Campo de contraseña con opción para mostrarla u ocultarla -->
                    <div class="grupo-formulario">
                        <label for="contrasena">Contraseña</label>
                        <div class="contrasena-container">
                            <input type="password" id="contrasena" name="contrasena" placeholder="***********" required>
                            <input type="checkbox" onclick="mostrarContrasena('contrasena')">
                        </div>
                    </div>
                    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                        <p style="color: red;">Error al logear.</p>
                    <?php endif; ?>
                    <!-- Botón para enviar el formulario -->
                    <button type="submit" class="boton-registro">Iniciar Sesión</button>
                </form>
                <!-- Área donde se mostrarán mensajes de error si los datos son incorrectos -->
                <div id="mensaje-error" style="color: red; margin-top: 10px;"></div>
                <!-- Enlace para redirigir a la página de registro si el usuario no tiene cuenta -->
                <p class="texto-inicio-sesion">¿No tienes cuenta? <a href="/BibliotecaProyectoG01/index.php?accion=register">REGISTRARME</a></p>
            </div>
        </div>
    </div>
    <!-- Script para manejar el envío del formulario y la validación de la contraseña -->
    <script src="/BibliotecaProyectoG01/assets/js/ValidaContra.js"></script>
</body>

</html>