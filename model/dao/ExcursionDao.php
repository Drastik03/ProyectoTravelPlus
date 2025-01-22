<?php
//AUTHOR: VEAS NOBOA JOHAN DAVID
require_once './config/Connection.php';
class ExcursionDao
{
    private $conn;
    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }
    public function getExcursion()
    {
        $sql = "SELECT excursion.*, category.name AS category_name 
        FROM excursion
        JOIN category ON excursion.category_id = category.id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $excursion = $stmt->fetchAll();
            return $excursion;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM excursion WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $e) {
            echo "Error en la eliminación: " . $e->getMessage();
            return false;
        }
    }
    
    public function update($excursion)
    {
        $sql = "UPDATE excursion 
                SET title = :title, 
                    image_route = :image_route, 
                    description = :description, 
                    duration = :duration, 
                    price = :price, 
                    category_id = :category_id, 
                    start_date = :start_date,
                    update_at = NOW()
                WHERE id = :id";   

        try {
            $id = $excursion->__get('id');
            $title = $excursion->__get('title');
            $imageRoute = $excursion->__get('imageRoute');
            $description = $excursion->__get('description');
            $duration = $excursion->__get('duration');
            $price = $excursion->__get('price');
            $categoryId = $excursion->__get('category_id');
            $startDate = $excursion->__get('start_date');
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':image_route', $imageRoute, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':start_date', $startDate, PDO::PARAM_STR);  
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $err) {
            echo "Error en la actualización: " . $err->getMessage();
            return false;
        }
    }

    public function insert($excursion)
    {
        $sql = "INSERT INTO excursion (title, image_route, description, duration, price, category_id, start_date) 
                VALUES (:title, :image_route, :description, :duration, :price, :category_id, :start_date)";
        
        try {
            $title = $excursion->__get('title');
            $imageRoute = $excursion->__get('imageRoute');
            $description = $excursion->__get('description');
            $duration = $excursion->__get('duration');
            $price = $excursion->__get('price');
            $categoryId = $excursion->__get('category_id');
            $startDate = $excursion->__get('start_date');

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':image_route', $imageRoute);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':category_id', $categoryId);
            $stmt->bindParam(':start_date', $startDate);

            // Depuración
            if ($stmt->execute()) {
                return true;
            } else {
                // Mostrar un mensaje si la consulta falla
                echo "Error al ejecutar la consulta";
                return false;
            }
        } catch (PDOException $err) {
            echo "Error de base de datos: " . $err->getMessage();
            return false;
        }
    }

    public function getExcursionById($id)
    {
        $sql = "SELECT * FROM excursion WHERE id = :id";
        try{
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }
        catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

        
   
    
}
?>