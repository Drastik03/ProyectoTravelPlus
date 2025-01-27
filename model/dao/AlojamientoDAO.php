<?php
//AUTHOR: ZAMBRANO RODRIGUEZ ANGEL DANIEL
require_once './config/Connection.php';
require_once './model/dto/CreateAlojamientoDTO.php';

session_start();
class AlojamientoDAO
{
    private $conn;
    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function all(){
        $sql = "SELECT * FROM alojamientos where disponible = 1";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $alojamientos = $stmt->fetchAll();
            return $alojamientos;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    public function search($param){
        $sql = "SELECT * FROM alojamientos where nombre like :param AND disponible = 1";
        try {
            $param = '%' . $param . '%';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":param", $param, PDO::PARAM_STR);
            $stmt->execute();
            $alojamientos = $stmt->fetchAll();
            return $alojamientos;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }

    }
    public function save(CreateAlojamientoDTO $alojamiento){
        $sql = "INSERT INTO alojamientos (nombre, descripcion, capacidad, precio, ubicacion, tipo, disponible, foto_base64) VALUES (:nombre, :descripcion, :capacidad, :precio, :ubicacion, :tipo, :disponible, :foto_base64)";
        try {
            $stmt = $this->conn->prepare($sql);
            $nombre = $alojamiento->getNombre();
            $descripcion = $alojamiento->getDescripcion();
            $capacidad = $alojamiento->getCapacidad();
            $precio = $alojamiento->getPrecio();
            $ubicacion = $alojamiento->getUbicacion();
            $tipo = $alojamiento->getTipo();
            $disponible = $alojamiento->getDisponible();
            $foto_base64 = $alojamiento->getBase_64();
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":capacidad", $capacidad, PDO::PARAM_INT);
            $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);
            $stmt->bindParam(":ubicacion", $ubicacion, PDO::PARAM_STR);
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $stmt->bindParam(":disponible", $disponible, PDO::PARAM_INT);
            $stmt->bindParam(":foto_base64", $foto_base64, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

   public function getById($id){
    $sql = "SELECT * FROM alojamientos where id = :id AND disponible = 1";
    try {
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $alojamiento = $stmt->fetch();
        return $alojamiento;
    } catch (PDOException $err) {
        echo $err->getMessage();
    }

   }

   public function save_comment(CreateCommentDTO $comment){
    $sql = "INSERT INTO comentarios_alojamientos (alojamiento_id, comentario, score, user_id) VALUES (:alojamiento_id, :comentario, :score, :user_id)";
    try {
        $stmt = $this->conn->prepare($sql);
        $alojamiento_id = $comment->getAlojamiento_id();
        $comentario = $comment->getComment();
        $score = $comment->getScore();
        $score = ($score / 10) * 5;
        $user_id = $comment->getUser_id();
        $stmt->bindParam(":alojamiento_id", $alojamiento_id, PDO::PARAM_INT);
        $stmt->bindParam(":comentario", $comentario, PDO::PARAM_STR);
        $stmt->bindParam(":score", $score, PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
   }

   public function getCommentsByAlojamientoId($id){
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM comentarios_alojamientos where alojamiento_id = :id AND user_id = :user_id";
    try {
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $comentarios = $stmt->fetchAll();
        return $comentarios;
    } catch (PDOException $err) {
        echo $err->getMessage();
    }


   }

   public function update(CreateAlojamientoDTO $aloj){
    $sql = "UPDATE alojamientos SET nombre = :nombre, descripcion = :descripcion, capacidad = :capacidad, precio = :precio, ubicacion = :ubicacion, tipo = :tipo, disponible = :disponible, foto_base64 = :foto_base64 WHERE id = :id";
    try {
        $stmt = $this->conn->prepare($sql);
        $nombre = $aloj->getNombre();
        $descripcion = $aloj->getDescripcion();
        $capacidad = $aloj->getCapacidad();
        $precio = $aloj->getPrecio();
        $ubicacion = $aloj->getUbicacion();
        $tipo = $aloj->getTipo();
        $disponible = $aloj->getDisponible();
        $foto_base64 = $aloj->getBase_64();
        $id = $aloj->getId();
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":capacidad", $capacidad, PDO::PARAM_INT);
        $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);
        $stmt->bindParam(":ubicacion", $ubicacion, PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":disponible", $disponible, PDO::PARAM_INT);
        $stmt->bindParam(":foto_base64", $foto_base64, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
   }
        
   
    
}
?>