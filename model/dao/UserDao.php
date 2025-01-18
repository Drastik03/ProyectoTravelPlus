<?php
require_once './config/Connection.php';
class UserDAO
{
    private $conn;
    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }
    public function insert($user)
    {
        // Definición correcta de la consulta SQL
        $sql = "INSERT INTO user (name, lastName, username, password, rol_id) VALUES (:name, :lastName, :username, :password, :rol_id)";
        try {
            // Preparamos la consulta SQL
            $stmt = $this->conn->prepare($sql);

            // Vinculamos los parámetros correctamente
            $name = $user->__get('name');
            $lastName = $user->__get('lastName');
            $username = $user->__get('username');
            $password = $user->__get('password');
            $rol_id = $user->__get('rol_id');

            // Vinculamos los parámetros correctamente utilizando las variables
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
            $res = $stmt->execute();
            if ($res) {
                $sql_roles = "INSERT INTO user_rol (user_id, rol_id) VALUES (:user_id, :rol_id)";
                $stmt_roles = $this->conn->prepare($sql_roles);
                $user_id = $this->conn->lastInsertId();
                $stmt_roles->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt_roles->bindParam(':rol_id',$rol_id);
                $stmt_roles->execute();
            }
            return $res;
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage();
            return false;  
        }
    }
}
?>