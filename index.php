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
    require_once __DIR__ . '/controller/generoControlador.php';
    $generoControlador = new generoControlador($pdo);
    //Enrutamientos
    $accion = $_GET['accion'] ?? 'inicio';

    switch ($accion){
        //rutas de cambio de pagina
        case 'inicio':
            $usuarioControlador->vistaInicio();
            //include 'view/generales/lobby.php';
            break;
        case 'login':
            include 'view/generales/login.php';
            break;
        case 'register':
            include 'view/generales/register.php';
            break;
        case 'logout':
            $usuarioControlador->logout();
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
        case 'ListadoLibrosBibli':
            include 'view/bibliotecario/ListadoLibrosBibli.php';
            break;
        case 'RegistroLibrosBibli':
            include 'view/bibliotecario/RegistroLibrosBibli.php';
            break;
        case 'SolicPrestBibli':
            include 'view/bibliotecario/SolicPrestBibli.php';
            break;
        case 'ListadoPrestBibli':
            include 'view/bibliotecario/ListadoPrestBibli.php';
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
        case 'buscarLibro':
            $librosControlador->buscarLibro($_POST);
            break;
        case 'solicitarLibro':
            $prestamoControlador->solicitarLibro($_POST);
            break;
        case 'listarPrestamosBibli':
            $prestamoControlador->listarPrestamosBibli($_POST);
            break;
        case 'marcarDevolucion':
            $prestamoControlador->marcarDevolucion($_POST);
            break;
        case 'listarPrestamos':
            $prestamoControlador->listarPrestamos($_POST);
            break;
        case 'cancelarSolicitudLibro':
            $prestamoControlador->cancelarSolicitudLibro($_POST);
            break;
        case 'AceptacionPrestamo':
            $prestamoControlador->AceptacionPrestamo($_POST);
            break;
        case 'buscarPrestamos':
            $prestamoControlador->buscarPrestamos($_POST);
            break;
        case 'CRUDlistarLiros':
            $librosControlador->CRUDlistarLiros();
            break;
        case 'CRUDinsertarLibro':
            $librosControlador->CRUDinsertarLibro($_POST);
            break;
        case 'ListarGeneros':
            $generoControlador->ListarGeneros();
            break;
        case 'EditarLibros':
            $librosControlador->EditarLibros($_POST);
            break;
        case 'EliminarLibro':
            $librosControlador->EliminarLibro($_POST);
            break;
        default:
            include 'view/generales/lobby.php';
            break;
    }
?>