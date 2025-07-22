<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../modelo/usuario.php';
class usuarioDao{
    private $db;
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    //Funciones a realizar
    public function procesarRegistro(usuario $usuario): bool {
        try{
            $con = $this->db;
            $sql = 'INSERT INTO usuario(cedula, nombre, apellido_paterno, apellido_materno, correo, direccion, contrasena, id_rol)
                    VALUES (:cedula, :nombre, :apellido_paterno, :apellido_materno, :correo, :direccion, :contrasena, :id_rol) ';
            $stmt = $con->prepare($sql);
            $passHasheada = password_hash($usuario->contrasena, PASSWORD_BCRYPT);
            $id_rol = $usuario->rol ?? 1;
            $stmt->bindParam(':cedula', $usuario->cedula);
            $stmt->bindParam(':nombre', $usuario->nombre);
            $stmt->bindParam(':apellido_paterno', $usuario->apellido_paterno);
            $stmt->bindParam(':apellido_materno', $usuario->apellido_materno);
            $stmt->bindParam(':correo', $usuario->correo);
            $stmt->bindParam(':direccion', $usuario->direccion);
            $stmt->bindParam(':contrasena', $passHasheada);
            $stmt->bindParam(':id_rol', $id_rol);
            $valor = $stmt->execute();
            return $valor;
        }catch (PDOException $e){
            error_log('Error al registrar usuario: ' . $e->getMessage());
            return false;
        }
    }
    public function procesarLogin(usuario $usuario){
        try{
            $con = $this->db;
            $sql = 'SELECT * FROM usuario WHERE cedula = :cedula';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':cedula', $usuario->cedula);
            $stmt->execute();
            $resp = $stmt->fetch();
            if ($resp && password_verify($usuario->contrasena, $resp['contrasena'])) {
                $usuarioData = [
                    'id_rol' => $resp['id_rol'],
                    'nombre' => $resp['nombre'],
                    'id' => $resp['id']
                ];
                return $usuarioData;
            }
            return false;

        }catch (PDOException $e){
            error_log('Error al iniciar sesion: ' . $e->getMessage());
            return false;
        }
    }
    public function CRUDlistarPersonas($post){
        try{
            $con = $this->db;
            $sql = 'SELECT cedula, nombre, apellido_paterno, apellido_materno, correo, direccion FROM usuario WHERE id_rol = :rol';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':rol', $post["rol"]);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }
    public function registrarUsuarioCRUD($post){
        try{
            $con = $this->db;
            $sql = 'INSERT INTO usuario(cedula, nombre, apellido_paterno, apellido_materno, correo, direccion, contrasena, id_rol)
                    VALUES (:cedula, :nombre, :apellido_paterno, :apellido_materno, :correo, :direccion, :contrasena, :id_rol) ';
            $stmt = $con->prepare($sql);
            $passHasheada = password_hash($post['contrasena'], PASSWORD_BCRYPT);
            $stmt->bindParam(':cedula', $post['cedula']);
            $stmt->bindParam(':nombre', $post['nombre']);
            $stmt->bindParam(':apellido_paterno', $post['apellido_paterno']);
            $stmt->bindParam(':apellido_materno', $post['apellido_materno']);
            $stmt->bindParam(':correo', $post['correo']);
            $stmt->bindParam(':direccion', $post['direccion']);
            $stmt->bindParam(':contrasena', $passHasheada);
            $stmt->bindParam(':id_rol', $post['rol']);
            $valor = $stmt->execute();
            return $valor;
        }catch (PDOException $e){
            error_log('Error al registrar usuario: ' . $e->getMessage());
            return false;
        }
    }
    public function EditarUsuario($post){
        try{
            $con = $this->db;
            $sql = 'UPDATE usuario SET
                    nombre = :nombre,
                    apellido_paterno = :apellido_paterno,
                    apellido_materno = :apellido_materno,
                    correo = :correo,
                    direccion = :direccion
                    WHERE cedula = :cedula';
            
            $stmt = $con->prepare($sql);

            $stmt->bindParam(':cedula', $post['cedula']);
            $stmt->bindParam(':nombre', $post['nombre']);
            $stmt->bindParam(':apellido_paterno', $post['apellido']);
            $stmt->bindParam(':apellido_materno', $post['apellidoMaterno']);
            $stmt->bindParam(':correo', $post['correo']);
            $stmt->bindParam(':direccion', $post['direccion']);
            
            return $stmt->execute();
        }catch (PDOException $e){
            error_log('Error al registrar usuario: ' . $e->getMessage());
            return false;
        }
    }
    public function EliminarUsuario($post){
        try{
            $con = $this->db;
            $sql = 'DELETE FROM usuario
                    WHERE cedula = :cedula';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':cedula', $post['cedula']);
            return $stmt->execute();
        }catch (PDOException $e){
            error_log('Error al registrar usuario: ' . $e->getMessage());
            return false;
        }
    }
}
?>