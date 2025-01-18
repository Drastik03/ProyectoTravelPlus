<?php
class Connection
{
    public static function getConnection()
    {
        $connection = null;
        try {
            $connection = new PDO(
                'mysql:host=localhost;dbname='. DB_NAME,
                DB_USERNAME,
                DB_PASSWORD
            );
            $connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            die("error " . $e->getMessage());
        }
        return $connection;
    }
}
?>