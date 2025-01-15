<?php
class Connection
{
    public static function getConnection()
    {
        $conn = null;
        try {
            $conn = new PDO(
                'mysql:host=localhost;dbname='. DB_NAME,
                DB_USERNAME,
                DB_PASSWORD
            );
            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            die("error " . $e->getMessage());
        }
        return $conn;
    }
}
?>