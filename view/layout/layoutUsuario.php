<header class="header">
    <h1 class="welcome"><a href="index.php?accion=inicioUser">Bienvenido</a></h1>
    <div class="button-group">
        <button class="logout-btn" onclick="location.href='/BibliotecaProyectoG01/index.php?accion=logout'">CERRAR SESIÓN</button>
        <button class="image-button" onclick="location.href=''">
            <img src="/BibliotecaProyectoG01/assets/img/user.png" alt="Login">
        </button>
    </div>
</header>

<div class="separator"></div>
<aside class="sidebar">
    <div class="menu-list">
        <button class="menu-button" onclick="location.href='index.php?accion=ListadoLibrosUsu'">Libros</button>
        <button class="menu-button" onclick="location.href='index.php?accion=ListadoPrestaUsu'">Préstamos</button>
        <button class="menu-button " onclick="location.href='index.php?accion=ListadoSoliPrestaUsu'">Solicitudes</button>
    </div>
</aside>