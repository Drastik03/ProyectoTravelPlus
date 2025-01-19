<?php
//AUTHOR: VEAS NOBOA JOHAN DAVID
require_once './config/Connection.php';
class ExcursionDao{
    private $conn;
    public function __construct(){
        $this->conn = Connection::getConnection();
    }
    public function getExcursion($param){
        $sql = "SELECT * FROM excursion";
        try{
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $excursion = $stmt->fetchAll();
            return $excursion;
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
}

?>