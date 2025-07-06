<?php
    require_once __DIR__ . '/config/database.php';
    $pdo = database::getConexion();

    require_once __DIR__ . '/controller/usuarioControlador.php';
    require_once __DIR__ . '/controller/librosControlador.php';
    require_once __DIR__ . '/controller/prestamoControlador.php';

    if (!$pdo){
        http_response_code(500);
        include 'view/500.php';
        exit();
    }

    $accion = $_GET['accion'] ?? 'inicio';

    $accionesProtegidas = [''];

    if (in_array($accion, $accionesProtegidas)){
        session_start();
        if(!isset($_SESSION['usuario'])){
            header("Location: index.php?accion=login");
            exit();
        }
    }
    switch ($accion){
        case 'login':
            include 'view/generales/login.php';
            break;
        case 'register':
            include 'view/generales/register.php';
            break;
        case 'procesarLogin':

            break;
        case '':
            break;
        case '':
            break;
        case '':
            break;
        default:
            include 'view/generales/lobby.php';
            break;
    }

?>