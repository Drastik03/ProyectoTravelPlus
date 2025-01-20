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
            return $stmt->execute();
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}
