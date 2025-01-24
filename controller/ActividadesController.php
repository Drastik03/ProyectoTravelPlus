<?php
//AUTHOR: Santacruz Salas Jostin Fabricio
include_once('../modelo/dao/ActividadesDAO.php');
include_once('../modelo/dto/ActividadesDTO.php');

class ActividadesController {

    public function registrarActividad() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $ubicacion = $_POST['ubicacion'];
            $hora = $_POST['hora'];
            $precio = $_POST['precio'];
            $imagen = $_POST['imagen'];

            $actividadesDTO = new ActividadesDTO(null, $nombre, $descripcion, $ubicacion, $hora, $precio, $imagen);

            $actividadesDAO = new ActividadesDAO();
            $actividadesDAO->crear($actividadesDTO);

            header("Location: ../view/listar_actividades.php");
        }
    }

    public function listarActividades() {
        $actividadesDAO = new ActividadesDAO();
        return $actividadesDAO->obtenerTodas();
    }

    public function editarActividad($id) {
        $actividadesDAO = new ActividadesDAO();
        $actividadesDTO = $actividadesDAO->obtenerPorId($id);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $actividadesDTO->nombre_actividad = $_POST['nombre'];
            $actividadesDTO->descripcion = $_POST['descripcion'];
            $actividadesDTO->ubicacion = $_POST['ubicacion'];
            $actividadesDTO->hora = $_POST['hora'];
            $actividadesDTO->precio = $_POST['precio'];
            $actividadesDTO->imagen = $_POST['imagen'];

            $actividadesDAO->actualizar($actividadesDTO);

            header("Location: ../view/listar_actividades.php");
        }

        return $actividadesDTO;
    }

    public function eliminarActividad($id) {
        $actividadesDAO = new ActividadesDAO();
        $actividadesDAO->eliminar($id);

        header("Location: ../view/listar_actividades.php");
    }
}
?>
