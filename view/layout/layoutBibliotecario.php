<header class="header">
    <h1 class="welcome"><a href="index.php?accion=inicioBibli">Bienvenido Bibliotecario</a></h1> <!-- Link a la página de inicio -->

    <div class="button-group"> <!-- Grupo de botones de usuario -->
        <!-- Botón para cerrar sesión -->
        <button class="logout-btn" onclick="location.href='/BibliotecaProyectoG01/index.php?accion=logout'">CERRAR SESIÓN</button>
        <!-- Botón con imagen del usuario (aquí no tiene funcionalidad concreta aún) -->
    </div>
</header>

<div class="separator"></div>

<aside class="sidebar">
    <div class="menu-list">
        <!-- Acceso al listado de libros -->
        <button class="menu-button" onclick="location.href='index.php?accion=ListadoLibrosBibli'">Libros</button>
        <!-- Acceso a solicitudes de préstamos realizados por los usuarios -->
        <button class="menu-button" onclick="location.href='index.php?accion=SolicPrestBibli'">Solicitudes de Préstamos</button>
        <!-- Acceso al historial de préstamos registrados en el sistema -->
        <button class="menu-button" onclick="location.href='index.php?accion=ListadoPrestBibli'">Listado de Préstamos</button>
        <button class="menu-button" onclick="location.href='index.php?accion=CRUDbibliotecario'">Listado de bilbiotecarios</button>
        <button class="menu-button" onclick="location.href='index.php?accion=CRUDlibros'">Listado de libros</button>
        <button class="menu-button" onclick="location.href='index.php?accion=CRUDprestamos'">CRUD de Préstamos</button>
        <button class="menu-button" onclick="location.href='index.php?accion=CRUDusaurios'">Listado de usuarios</button>
    </div>
</aside>