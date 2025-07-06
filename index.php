<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once __DIR__ . '/config/database.php';
    $pdo = database::getConexion();
    if (!$pdo){
        http_response_code(500);
        include 'view/errors/500.php';
        exit();
    }
    require_once __DIR__ . '/controller/usuarioControlador.php';
    $usuarioControlador = new usuarioControlador($pdo);
    require_once __DIR__ . '/controller/librosControlador.php';
    $librosControlador = new librosControlador($pdo);
    require_once __DIR__ . '/controller/prestamoControlador.php';
    $prestamoControlador = new prestamoControlador($pdo);
    //Enrutamientos
    $accion = $_GET['accion'] ?? 'inicio';

    switch ($accion){
        //rutas de cambio de pagina
        case 'inicio':
            include 'view/generales/lobby.php';
            break;
        case 'login':
            include 'view/generales/login.php';
            break;
        case 'register':
            include 'view/generales/register.php';
            break;
        //usuario
        case 'inicioUser':
            include 'view/usuarios/InicioUser.php';
            break;
        case 'ListadoLibrosUsu':
            include 'view/usuarios/ListadoLibrosUsu.php';
            break;
        case 'ListadoPrestaUsu':
            include 'view/usuarios/ListadoPrestaUsu.php';
            break;
        case 'ListadoSoliPrestaUsu':
            include 'view/usuarios/ListadoSoliPrestaUsu.php';
            break;
        //bibliotecario
        case 'inicioBibli':
            include 'view/bibliotecario/InicioBibliotec.php';
            break;
        //rutas de controlladores
        case 'registrarUsuario':
            $usuarioControlador->procesarRegistro($_POST);
            break;
        case 'procesarLogin':
            $usuarioControlador->procesarLogin($_POST);
            break;
        case 'listarLibros':
            $librosControlador->listarLibros($_POST);
            break;
        case 'solicitarLibro':
            $prestamoControlador->solicitarLibro($_POST);
            break;
        default:
            include 'view/generales/lobby.php';
            break;
    }

?>