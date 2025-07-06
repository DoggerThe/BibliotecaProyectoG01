<?php
require_once __DIR__ . '/../model/dao/usuarioDao.php';
require_once __DIR__ . '/../model/modelo/usuario.php';

class usuarioControlador{
    private $usuarioDao;
    private $usuario;
    public function __construct($pdo)
    {
        $this->usuarioDao = New UsuarioDao($pdo);
        $this->usuario = New Usuario();
    }
}
?>