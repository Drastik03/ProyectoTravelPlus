<?php
//AUTHOR: VEAS NOBOA JOHAN DAVID
require_once './model/dao/ExcursionDao.php';
require_once './model/dao/ExcursionDao.php';
require_once './model/dto/Excursion.php';
require_once './model/dao/CategoryDao.php';
require_once './helpers/redirect.php';
class ExcursionController
{
    private $model;
    public function __construct()
    {
        $this->model = new ExcursionDao();
    }
    public function index()
    {
        $excursiones = $this->model->getExcursion();
        require_once './view/excursions/excursions.list.php';
    }
    public function view_new()
    {
        $modelCategory = new CategoryDao();
        $categorias = $modelCategory->getAllCategory();
        require_once './view/excursions/excursions.new.php';
    }
    public function new(){
        // Verificar si la solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }
        $excursion = $this->populate();
        print_r($excursion);
        //validamos si no estan vacios
        if(empty($excursion->__get('title')) || empty($excursion->__get('description')) || empty($excursion->__get('price')) || empty($excursion->__get('duration')) || empty($excursion->__get('start_date')) || empty($excursion->__get('category_id'))
        || empty($excursion->__get('imageRoute'))) {
            header('Location: index.php?app=excursion&action=view_new');
        }
        if (!empty($_FILES['imagen']['name'])) {
            $tempFileName = $_FILES['imagen']['tmp_name'];
            $imageRoute = '/assets/images/uploads/excursions/' . basename($_FILES['imagen']['name']);
            $imageDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/uploads/excursions/';
            if (!is_dir($imageDir)) {
                if (mkdir($imageDir, 0777, true)) {
                    echo "Directorio creado con éxito.";
                } else {
                    echo "Error al crear el directorio.";
                }
            }
            if (chmod($imageDir, 0777)) {
                echo "Permisos cambiados exitosamente.";
            } else {
                echo "Error al cambiar permisos.";
            }
            if (move_uploaded_file($tempFileName, $_SERVER['DOCUMENT_ROOT'] . $imageRoute)) {
                echo "Archivo subido correctamente.";
            } else {
                echo "Error al subir el archivo.";
            }
        }
        print_r($excursion);
        $this->model->insert($excursion);
        header('Location: index.php?app=excursion&action=index');
    }
    private function populate(){
        // Crear una nueva instancia de Excursión
        $excursion = new Excursion();
        
        // Asignar valores a los campos de la excursión desde $_POST
        $excursion->__set('title', $_POST['nombre']); // Título de la excursión
        $excursion->__set('category_id', $_POST['categoria']); // Categoría de la excursión
        $excursion->__set('description', $_POST['descripcion']); // Descripción
        $excursion->__set('price', $_POST['precio']); // Precio
        $excursion->__set('duration', $_POST['duracion']); // Duración
        $excursion->__set('start_date', $_POST['fecha_inicio']); // Fecha de inicio
        
        return $excursion;
    }

    public function clean()
    {
        $excursion = new Excursion();
        $excursion->__set('id', $_POST['id']);
        $excursion->__set('title', $_POST['nombre']);
        $excursion->__set('imageRoute', isset($tempFileName) ? $tempFileName : $excursion['image_route']);
        $excursion->__set('description', $_POST['descripcion']);
        $excursion->__set('duration', $_POST['duracion']);
        $excursion->__set('price', $_POST['precio']);
        $excursion->__set('category_id', $_POST['categoria']);
        $excursion->__set('start_date', $_POST['fecha_inicio']);
    }
    public function view_edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id']; // Obtener el ID de la excursión desde la URL
            $excursion = $this->model->getExcursionById($id); // Obtener la excursión por ID
            
            if ($excursion) {
                $modelCategory = new CategoryDao();
                $categorias = $modelCategory->getAllCategory();
                require './view/excursions/excursions.edit.php'; 
            } else {
                echo "No se encontró la excursión."; 
                $msg = new RedirectWithMessage(
                    false,
                    "Excursión no encontrada",
                    "No se encontró la excursión que intentas editar.",
                    "index.php?app=excursion&action=index"
                );
                $msg->redirectWithMessage();
            }
        } else {
            $msg = new RedirectWithMessage(
                false,
                "Error: ID faltante",
                "El ID de la excursión es obligatorio.",
                "index.php?app=excursion&action=index"
            );
            $msg->redirectWithMessage();
        }
    }




    public function delete_exursion()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            header("Location: index.php?app=excursion&action=index&error=No se ha proporcionado un ID válido para la excursión");
            exit();
        }
        try {
            $excursion = $this->model->getExcursionById($id);
            if ($excursion) {
                $imageRoute = $excursion['imageRoute']; 
                $imagePath = './assets/images/uploads/excursions/' . $imageRoute;  
                if (file_exists($imagePath)) {
                    unlink($imagePath);  
                }
            }
            $deleted = $this->model->delete($id);
            if ($deleted) {
                header("Location: index.php?app=excursion&action=index&success=Excursión eliminada con éxito");
            } else {
                header("Location: index.php?app=excursion&action=index&error=Hubo un error al eliminar la excursión. Intenta nuevamente.");
            }
            exit();
        } catch (Exception $err) {
            header("Location: index.php?app=excursion&action=index&error=Hubo un error inesperado. Intenta nuevamente.");
            exit();
        }
    }


    

}
?>