<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../model/dao/librosDao.php';
require_once __DIR__ . '/../model/modelo/libros.php';

class librosControlador{
    private $librosDao;
    public function __construct($pdo){
        $this->librosDao = New librosDao($pdo);
    }
    public function listarLibros($post){
        $id = $post['rolUsuario'];
        $resultado = $this->librosDao->listarLibros($id);
        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit();
    }
    public function buscarLibro($post){
        $termino = $post['termino'];
        $id = $post['rolUsuario'];

        if(empty($termino)){
            $this->listarLibros($post);
            exit();
        } 

        $resultado = $this->librosDao->buscarLibro($id, $termino);
        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit();
    }
}
?>