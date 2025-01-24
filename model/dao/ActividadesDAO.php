<?php
//AUTHOR: Santacruz Salas Jostin Fabricio
include_once('./config/Connection.php');
include_once('dto/ActividadesDTO.php');

class ActividadesDAO {

    public function crear(ActividadesDTO $actividadesDTO) {
        $sql = "INSERT INTO actividades (nombre_actividad, descripcion, ubicacion, hora, precio, imagen) 
                VALUES ('{$actividadesDTO->nombre_actividad}', '{$actividadesDTO->descripcion}', '{$actividadesDTO->ubicacion}', '{$actividadesDTO->hora}', '{$actividadesDTO->precio}', '{$actividadesDTO->imagen}')";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerTodas() {
        $sql = "SELECT * FROM actividades";
        $result = mysqli_query($conn, $sql);
        $actividades = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $actividad = new ActividadesDTO(
                $row['id'],
                $row['nombre_actividad'],
                $row['descripcion'],
                $row['ubicacion'],
                $row['hora'],
                $row['precio'],
                $row['imagen'],
                $row['fecha_creacion'],
                $row['fecha_actualizacion'],
                $row['usuario_actualizacion']
            );
            $actividades[] = $actividad;
        }

        return $actividades;
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM actividades WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        return new ActividadesDTO(
            $row['id'],
            $row['nombre_actividad'],
            $row['descripcion'],
            $row['ubicacion'],
            $row['hora'],
            $row['precio'],
            $row['imagen'],
            $row['fecha_creacion'],
            $row['fecha_actualizacion'],
            $row['usuario_actualizacion']
        );
    }

    public function actualizar(ActividadesDTO $actividadesDTO) {
        $sql = "UPDATE actividades SET 
                nombre_actividad = '{$actividadesDTO->nombre_actividad}', 
                descripcion = '{$actividadesDTO->descripcion}', 
                ubicacion = '{$actividadesDTO->ubicacion}', 
                hora = '{$actividadesDTO->hora}', 
                precio = '{$actividadesDTO->precio}', 
                imagen = '{$actividadesDTO->imagen}' 
                WHERE id = {$actividadesDTO->id}";
        
        return mysqli_query($conn, $sql);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM actividades WHERE id = $id";
        return mysqli_query($conn, $sql);
    }
}
?>
