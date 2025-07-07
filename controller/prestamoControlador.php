<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../model/dao/prestamoDao.php';
require_once __DIR__ . '/../model/modelo/prestamo.php';

class prestamoControlador{
    private $prestamoDao;
    public function __construct($pdo)
    {
        $this->prestamoDao = New prestamoDao($pdo);
    }
    public function solicitarLibro($post){
        $prestamo = new prestamo();
        $prestamo->usuario = trim($post['id_usuario']);
        $prestamo->libro = trim($post['id_libro']);
        $prestamo->fecha_solicitud = trim($post['fecha_solicitud']);
        $prestamo->fecha_inicio_prestamo = trim($post['fecha_inicio']);
        $prestamo->fecha_fin_prestamo = trim($post['fecha_fin']);
        $prestamo->estado = 3;

        $Dao = $this->prestamoDao;
        if($Dao->solicitarLibro($prestamo)){
            $respuesta = ['success' => true,
                    'mensaje' => 'Registrado con exito.'];
        }else{
            $respuesta = ['success' => false,
                    'mensaje' => 'error al registrar.'];
        }
        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit();
    }
    public function listarPrestamos($post){
        $prestamo = new prestamo();
        $prestamo->usuario = $post['id_usuario'];
        $prestamo->estado = $post['estado'];

        $Dao = $this->prestamoDao;
        $respuesta  = $Dao->listarPrestamos($prestamo);
        $saneado = [];
        foreach($respuesta as $row){
            $saneado[] = [
                'id_prestamo' => $row['id'],
                'libro' => $row['libro'],
                'fecha_inicio' => $row['fecha_inicio_prestamo'],
                'fecha_fin' => $row['fecha_fin_prestamo']
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($saneado);
        exit();
    }
}
?>