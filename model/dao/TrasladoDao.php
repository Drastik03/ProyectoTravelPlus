<?php
// AUTHOR: MOSQUERA VERGARA GEORGE ARIEL
require_once './config/Connection.php';
require_once './model/dto/Traslado.php'; 
class TrasladoDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function getTraslados()
    {
        $sql = "SELECT * FROM traslado"; 
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->mapToTrasladoObjects($result); 
        } catch (PDOException $err) {
            echo "Error al obtener traslados: " . $err->getMessage();
            return [];
        }
    }

    public function selectAll($parametro = null)
    {
    try {
        if ($parametro) {
            $sql = "SELECT * FROM traslado
                    WHERE id LIKE :param
                    OR origen LIKE :param
                    OR destino LIKE :param
                    OR precio LIKE :param
                    OR fecha_recogida LIKE :param
                    OR hora_recogida LIKE :param"; // Agregar búsqueda por fecha y hora
            $parametro = "%" . $parametro . "%";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":param", $parametro, PDO::PARAM_STR);
        } else {
            $sql = "SELECT * FROM traslado";
            $stmt = $this->conn->prepare($sql);
        }

          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $this->mapToTrasladoObjects($result); 
        } catch (PDOException $err) {
        error_log("Error en selectAll de TrasladoDao: " . $err->getMessage());
        return [];
        }
     }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM traslado WHERE id = :id"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $err) {
            echo "Error en la eliminación: " . $err->getMessage();
            return false;
        }
    }

    public function update(Traslado $traslado)
    {
        $sql = "UPDATE traslado 
                SET origen = :origen, 
                    destino = :destino, 
                    fecha_recogida = :fecha_recogida, 
                    hora_recogida = :hora_recogida, 
                    cantidad_pasajeros = :cantidad_pasajeros, 
                    precio = :precio
                WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $traslado->getId(), PDO::PARAM_INT);
            $stmt->bindParam(':origen', $traslado->getOrigen(), PDO::PARAM_STR);
            $stmt->bindParam(':destino', $traslado->getDestino(), PDO::PARAM_STR);
            $stmt->bindParam(':fecha_recogida', $traslado->getFechaRecogida(), PDO::PARAM_STR);
            $stmt->bindParam(':hora_recogida', $traslado->getHoraRecogida(), PDO::PARAM_STR);
            $stmt->bindParam(':cantidad_pasajeros', $traslado->getCantidadPasajeros(), PDO::PARAM_INT);
            $stmt->bindParam(':precio', $traslado->getPrecio(), PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $err) {
            echo "Error en la actualización: " . $err->getMessage();
            return false;
        }
    }

    public function insert(Traslado $traslado)
    {
        $sql = "INSERT INTO traslado (origen, destino, fecha_recogida, hora_recogida, cantidad_pasajeros, precio) 
                VALUES (:origen, :destino, :fecha_recogida, :hora_recogida, :cantidad_pasajeros, :precio)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':origen', $traslado->getOrigen(), PDO::PARAM_STR);
            $stmt->bindParam(':destino', $traslado->getDestino(), PDO::PARAM_STR);
            $stmt->bindParam(':fecha_recogida', $traslado->getFechaRecogida(), PDO::PARAM_STR);
            $stmt->bindParam(':hora_recogida', $traslado->getHoraRecogida(), PDO::PARAM_STR);
            $stmt->bindParam(':cantidad_pasajeros', $traslado->getCantidadPasajeros(), PDO::PARAM_INT);
            $stmt->bindParam(':precio', $traslado->getPrecio(), PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $err) {
            echo "Error al insertar el traslado: " . $err->getMessage();
            return false;
        }
    }

    public function getTrasladoById($id)
    {
        $sql = "SELECT * FROM traslado WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $this->mapToTrasladoObject($result); 
        } catch (PDOException $err) {
            echo "Error al obtener traslado por ID: " . $err->getMessage();
            return null;
        }
    }

    
    private function mapToTrasladoObject($data)
    {
        if ($data) {
            return new Traslado(
                $data['id'],
                $data['origen'],
                $data['destino'],
                $data['fecha_recogida'],
                $data['hora_recogida'],
                $data['cantidad_pasajeros'],
                $data['precio']
            );
        }
        return null;
    }

    private function mapToTrasladoObjects($dataArray)
    {
        $traslados = [];
        foreach ($dataArray as $data) {
            $traslados[] = $this->mapToTrasladoObject($data);
        }
        return $traslados;
    }
}
?>