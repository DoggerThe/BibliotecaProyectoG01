<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../model/dao/usuarioDao.php';
require_once __DIR__ . '/../model/modelo/usuario.php';

class usuarioControlador{
    private $usuarioDao;
    public function __construct($pdo)
    {
        $this->usuarioDao = New UsuarioDao($pdo);
    }
    public function procesarRegistro($post){
        $usuario = new usuario();
        $usuario->cedula = trim($post['cedula']);
        $usuario->nombre = trim($post['nombre']);
        $usuario->apellido_paterno = trim($post['apellidoPater']);
        $usuario->apellido_materno = trim($post['apellidoMater'] ?? '');
        $usuario->correo = trim($post['email']);
        $usuario->direccion = trim($post['direccion']);
        $usuario->contrasena = $post['password'];

        $Dao = $this->usuarioDao;
        if($Dao->procesarRegistro($usuario)){
            header("Location: index.php?accion=login");
        }else{
            header("Location: index.php?accion=register&error=1");
        }
        exit();
    }
    public function procesarLogin($post){
        $usuario = new usuario();
        $usuario->cedula = trim($post['usuario']);
        $usuario->contrasena = $post['contrasena'];

        $Dao = $this->usuarioDao;
        $resp = $Dao->procesarLogin($usuario);
        if($resp){
            $_SESSION['rolUsuario'] = $resp['id_rol'];
            $_SESSION['nombreUsuario'] = $resp['nombre'];
            $_SESSION['idUsuario'] = $resp['id'];
            if($resp['id_rol'] == 1){
                header("Location: index.php?accion=inicioUser");
                exit();
            }elseif($resp['id_rol'] == 2){
                header("Location: index.php?accion=inicioBibli");
                exit();
            }
        }else{
            header("Location: index.php?accion=login&error=1");
            exit();
        }
        exit();

    }
}
?>