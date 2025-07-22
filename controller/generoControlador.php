<?php
require_once __DIR__ . '/../model/dao/generosDao.php';
class generoControlador{
    private $generosDao;
    public function __construct($pdo){
        $this->generosDao = New generosDao($pdo);
    }
    public function ListarGeneros(){
        $resultado = $this->generosDao->ListarGeneros();
        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit();
    }
}
?>