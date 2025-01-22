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
        // Obtener los valores del objeto $excursion
        $id = $excursion->__get('id');
        $title = $excursion->__get('title');
        $imageRoute = $excursion->__get('imageRoute');
        $description = $excursion->__get('description');
        $duration = $excursion->__get('duration');
        $price = $excursion->__get('price');
        $categoryId = $excursion->__get('category_id');
        $startDate = $excursion->__get('start_date');

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);

        // Enlazar los parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':image_route', $imageRoute, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);  // O PDO::PARAM_INT si es un valor entero
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':start_date', $startDate, PDO::PARAM_STR);  // Asegúrate de que el formato de la fecha sea correcto (Y-m-d)

        // Ejecutar la consulta y devolver el resultado
        return $stmt->execute();

    } catch (PDOException $err) {
        echo "Error en la actualización: " . $err->getMessage();
        return false;
    }
}

    public function insert($excursion){
        $sql = "INSERT INTO excursion (title, image_route, description, duration, price, category_id, start_date) VALUES (:title, :image_route, :description, :duration, :price, :category_id, :start_date)";
        try {
            // Preparar la consulta
            $stmt = $this->conn->prepare($sql);
            
            // Enlazar los parámetros
            $stmt->bindParam(':title', $excursion->__get('title'), PDO::PARAM_STR);
            $stmt->bindParam(':image_route', $excursion->__get('imageRoute'), PDO::PARAM_STR);
            $stmt->bindParam(':description', $excursion->__get('description'), PDO::PARAM_STR);
            $stmt->bindParam(':duration', $excursion->__get('duration'), PDO::PARAM_INT);
            $stmt->bindParam(':price', $excursion->__get('price'), PDO::PARAM_STR);  // O PDO::PARAM_INT si es un valor entero
            $stmt->bindParam(':category_id', $excursion->__get('category_id'), PDO::PARAM_INT);
            $stmt->bindParam(':start_date', $excursion->__get('start_date'), PDO::PARAM_STR);  // Asegúrate de que el formato de la fecha sea correcto (Y-m-d)
            
            // Ejecutar la consulta y devolver el resultado
            if ($stmt->execute()) {
                echo "Datos insertados correctamente";
            } else {
                echo "Error al insertar los datos";
            }
            
            return $stmt->execute();
        } catch (PDOException $err) {
            // Log de errores
            echo "Error en insert de ExcursionesDAO: " . $err->getMessage();
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