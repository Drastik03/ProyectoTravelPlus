<?php
require_once './config/Connection.php';
class CategoryDao{
    private $conn;
    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }
    public function getAllCategory(){
        $query = "SELECT * FROM category";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage(); 
        }
    }
}

?>