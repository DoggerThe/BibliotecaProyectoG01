<?php
require_once __DIR__ . '/../../config/database.php';
class generosDao{
    private $db;
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    public function ListarGeneros(){
        try{
            $sql = 'SELECT id, genero FROM generolibros';
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