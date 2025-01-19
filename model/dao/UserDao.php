<?php
require_once './config/Connection.php';
class UserDAO
{
    private $conn;
    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }
    public function getAllUsers($limit, $offset)
    {
        $sql = "SELECT * FROM user LIMIT :limit OFFSET :offset";  
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage();  
            return [];  
        }
    }
    public function getTotalUsers()
    {
        $sql = "SELECT COUNT(*) FROM user";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage();
            return 0;
        }
    }

    public function insert($user)
    {
        $sql = "INSERT INTO user (name, lastName, username, password, rol_id) VALUES (:name, :lastName, :username, :password, :rol_id)";
        try {
            $stmt = $this->conn->prepare($sql);
            $name = $user->__get('name');
            $lastName = $user->__get('lastName');
            $username = $user->__get('username');
            $password = $user->__get('password');
            $rol_id = $user->__get('rol_id');
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
                $stmt_roles->bindParam(':rol_id', $rol_id);
                $stmt_roles->execute();
            }
            return $res;
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage();
            return false;
        }
    }
    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = :username LIMIT 1";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage();
            return false;
        }
    }
}
