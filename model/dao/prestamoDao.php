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
    public function listarPrestamos(prestamo $prestamo) :array{
        try{
            $con = $this->db;
            $sql = 'SELECT 
                        p.id, l.titulo AS libro, p.fecha_inicio_prestamo, p.fecha_fin_prestamo
                    FROM prestamo p
                    INNER JOIN libros l ON p.id_libro = l.id
                    WHERE p.id_usuario = :id_usuario AND p.id_estado = :id_estado;';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_usuario',$prestamo->usuario);
            $stmt->bindParam(':id_estado',$prestamo->estado);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }
    public function cancelarSolicitudLibro(prestamo $prestamo){
        try{
            $con = $this->db;
            $sql = 'UPDATE prestamo 
                    SET id_estado = :id_estado
                    WHERE id_usuario = :id_usuario AND id = :id AND id_estado = :Previo';
            $stmt = $con->prepare($sql);
            $var = 3;
            $stmt->bindParam(':id_estado',$prestamo->estado);
            $stmt->bindParam(':id_usuario',$prestamo->usuario);
            $stmt->bindParam(':id',$prestamo->id);
            $stmt->bindParam(':Previo', $var);
            $stmt->execute();
            return $stmt->rowCount();
        }catch (PDOException $e){
            error_log('Error: ' . $e->getMessage());
            return 0;
        }
    }
    public function listarPrestamosBibli(prestamo $prestamo){
        try{
            $con = $this->db;
            $estado = $prestamo->estado;
            $sql = 'SELECT 
                        p.id,
                        u.cedula AS cedula_usuario,
                        l.titulo AS libro,
                        p.fecha_solicitud, 
                        p.fecha_inicio_prestamo, 
                        p.fecha_fin_prestamo,
                        e.estado AS estado
                    FROM prestamo p
                    INNER JOIN libros l ON p.id_libro = l.id
                    INNER JOIN estado e ON p.id_estado = e.id
                    INNER JOIN usuario u ON p.id_usuario = u.id
                    WHERE p.id_estado = :id_estado;';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_estado', $estado);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }
    public function AceptacionPrestamo (prestamo $presta){
        try{
            $con = $this->db;
            $idPres = $presta->id;
            $idbibliotecario = $presta->bibliotecario;
            $estadoNuevo = $presta->estado;
            $sql = 'UPDATE prestamo 
                    SET
                        id_bibliotecario = :id_bibliotecario,
                        id_estado = :id_estado
                    WHERE id = :idPrestamo;';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_bibliotecario', $idbibliotecario);
            $stmt->bindParam(':id_estado', $estadoNuevo);
            $stmt->bindParam(':idPrestamo', $idPres);
            $stmt->execute();
            return $stmt->rowCount();
        }catch (PDOException $e){
            error_log('Error: ' . $e->getMessage());
            return 0;
        }
    }
}
?>