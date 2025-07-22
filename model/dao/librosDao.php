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
                            generolibros g ON l.id_genero = g.id
                        ORDER BY l.ISBN';
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
    public function buscarLibro($id, $termino): array {
        try {
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
                        generolibros g ON l.id_genero = g.id
                    WHERE ';
            
            // Condición dinámica según el ID
            $condiciones = [];
            if ($id == 1) {
                $condiciones[] = 'l.cantidad >= 1';
            } elseif ($id != 2) {
                return []; // ID no válido
            }
            $condiciones[] = '(l.ISBN LIKE :ISBN
                            OR l.titulo LIKE :titulo 
                            OR l.autor LIKE :autor 
                            OR g.genero LIKE :genero 
                            OR l.editorial LIKE :editorial)';
            // Construcción final de la consulta
            $sql .= implode(' AND ', $condiciones);

            $stmt = $this->db->prepare($sql);
            $likeTermino = '%'.$termino.'%';

            $stmt->bindParam(':ISBN', $likeTermino);
            $stmt->bindParam(':titulo', $likeTermino);
            $stmt->bindParam(':autor', $likeTermino);
            $stmt->bindParam(':genero', $likeTermino);
            $stmt->bindParam(':editorial', $likeTermino);

            $stmt->execute();
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }
    //NuevoRegistro.
    public function insertarLibro($post){
        try{
            $revisar = 'SELECT ISBN FROM libros WHERE ISBN = :isbn';
            $stmt1 = $this->db->prepare($revisar);
            $stmt1->bindParam(':isbn', $post['isbn']);
            $stmt1->execute();
            if($stmt1->fetch()){
                return false;
            }else{
                $sql = 'INSERT INTO libros(ISBN, titulo, id_genero, autor, editorial, cantidad) 
                        VALUES (:ISBN, :titulo, :id_genero, :autor, :editorial, :cantidad)';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':ISBN', $post['isbn']);
                $stmt->bindParam(':titulo', $post['titulo']);
                $stmt->bindParam(':id_genero', $post['genero']);
                $stmt->bindParam(':autor', $post['autor']);
                $stmt->bindParam(':editorial', $post['editorial']);
                $stmt->bindParam(':cantidad', $post['cantidad']);
                return $stmt->execute();
            }
            return false;
        }catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }
    public function EditarLibros($post){
        try {
            $revisar = 'SELECT ISBN FROM libros WHERE ISBN = :isbn';
            $stmt1 = $this->db->prepare($revisar);
            $stmt1->bindParam(':isbn', $post['isbn']);
            $stmt1->execute();
            
            if($stmt1->fetch()) {
                $sql = 'UPDATE libros SET 
                        titulo = :titulo, 
                        id_genero = :id_genero, 
                        autor = :autor, 
                        editorial = :editorial, 
                        cantidad = :cantidad 
                        WHERE ISBN = :ISBN';
                
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':ISBN', $post['isbn']);
                $stmt->bindParam(':titulo', $post['titulo']);
                $stmt->bindParam(':id_genero', $post['genero']);
                $stmt->bindParam(':autor', $post['autor']);
                $stmt->bindParam(':editorial', $post['editorial']);
                $stmt->bindParam(':cantidad', $post['cantidad']);
                
                return $stmt->execute();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }
    public function EliminarLibro($post){
        try{
            $sql = 'DELETE FROM libros WHERE ISBN = :isbn';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':isbn', $post['isbn']);
            return $stmt->execute();
        }catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }
}
?>