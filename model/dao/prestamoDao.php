<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../modelo/prestamo.php';
class prestamoDao{
    private $db;
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    //Funciones a realizar
    public function solicitarLibro(prestamo $prestamo) :bool{
        try{
            $con = $this->db;
            $sql = 'INSERT INTO prestamo (id_usuario, id_libro, fecha_solicitud, fecha_inicio_prestamo, fecha_fin_prestamo, id_estado)
                    VALUES (:id_usuario, :id_libro, :fecha_solicitud, :fecha_inicio_prestamo, :fecha_fin_prestamo, :id_estado);';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_usuario',$prestamo->usuario);
            $stmt->bindParam(':id_libro',$prestamo->libro);
            $stmt->bindParam(':fecha_solicitud',$prestamo->fecha_solicitud);
            $stmt->bindParam(':fecha_inicio_prestamo',$prestamo->fecha_inicio_prestamo);
            $stmt->bindParam(':fecha_fin_prestamo',$prestamo->fecha_fin_prestamo);
            $stmt->bindParam(':id_estado',$prestamo->estado);

            return $stmt->execute();
        }catch (PDOException $e){
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }
}
?>