<?php
require_once __DIR__ . '/../../config/database.php';
class librosDao{
    private $db;
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    //Funciones a realizar
    public function listarLibros($id): array{
        try{
            if ($id == 1){
                $sql = 'SELECT 
                            l.id, 
                            l.ISBN, 
                            l.titulo, 
                            g.genero AS genero,
                            l.autor, 
                            l.editorial, 
                            l.cantidad
                        FROM 
                            libros l
                        INNER JOIN 
                            generolibros g ON l.id_genero = g.id  -- Relación entre las tablas
                        WHERE 
                            l.cantidad >= 1;';
            }elseif($id == 2){
                $sql = 'SELECT 
                            l.id, 
                            l.ISBN, 
                            l.titulo, 
                            g.genero AS genero,
                            l.autor, 
                            l.editorial, 
                            l.cantidad
                        FROM 
                            libros l
                        INNER JOIN 
                            generolibros g ON l.id_genero = g.id';
            }else{
                return [];
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }
}
?>