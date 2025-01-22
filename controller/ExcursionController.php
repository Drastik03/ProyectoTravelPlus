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
    public function search() {
        $parametro = htmlentities($_POST['search'] ?? ""); 
        $excursiones = $this->model->selectAll($parametro); 
        require_once './view/excursions/excursions.list.php';
    }
    public function register_excursion()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $msg = new RedirectWithMessage();
            $msg->redirectWithMessage(
                false,
                "Error: Método no permitido",
                "Solo mediante el método POST",
                "index.php?app=excursion&action=index"
            );
            return;
        }
        try {
            if (empty($_POST['nombre']) || empty($_POST['categoria']) || empty($_POST['fecha_inicio']) || empty($_POST['descripcion'])) {
                $msg = new RedirectWithMessage(
                    false,
                    "Error: Campos faltantes",
                    "Por favor, complete todos los campos requeridos.",
                    "index.php?app=excursion&action=view_new"
                );
                return;
            }
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['imagen']['tmp_name'];
                $fileName = $_FILES['imagen']['name'];
                $uploadDir = './assets/images/uploads/excursions/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $tempFileName = uniqid('excursion_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destPath = $uploadDir . $tempFileName;
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $excursion = $this->clean();
                    $excursion->__set('imageRoute', $tempFileName); 
                    if ($this->model->insert($excursion)) {
                        header('Location:index.php?app=excursion&action=index');
                    } else {
                        echo "Error al registrar la excursión.";
                    }
                } else {
                    $msg = new RedirectWithMessage(
                        false,
                        "Error al subir la imagen",
                        "Hubo un problema al intentar subir la imagen. Intenta nuevamente.",
                        "index.php?app=excursion&action=view_new"
                    );
                }
            } else {
                $msg = new RedirectWithMessage(
                    false,
                    "Error al procesar el archivo",
                    "No se ha seleccionado un archivo o el archivo es inválido.",
                    "index.php?app=excursion&action=view_new"
                );
            }
        } catch (Exception $err) {
            $msg = new RedirectWithMessage(
                false,
                "Error inesperado",
                "Hubo un error inesperado. Intenta nuevamente.",
                "index.php?app=excursion&action=view_new"
            );
            echo "Error: " . $err->getMessage();
        }
    }

    public function clean()
    {
        $excursion = new Excursion();
        $excursion->__set('title', htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
        $excursion->__set('category_id', htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'UTF-8'));
        $excursion->__set('description', htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8'));
        if (isset($_FILES['imagen'])) {
            $excursion->__set('imageRoute', $_FILES['imagen']['name']);
        }
        $excursion->__set('price', htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8'));
        $excursion->__set('duration', htmlspecialchars($_POST['duracion'], ENT_QUOTES, 'UTF-8'));
        $excursion->__set('start_date', htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8'));
        return $excursion;
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

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                if (empty($_POST['nombre']) || empty($_POST['categoria']) || empty($_POST['fecha_inicio']) || empty($_POST['descripcion'])) {
                    $msg = new RedirectWithMessage(
                        false,
                        "Error: Campos faltantes",
                        "Por favor, complete todos los campos requeridos.",
                        "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
                    );
                    return;
                }

                $imageRoute = null;
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imageRoute = $this->handleImageUpload($_FILES['image']);
                } else {
                    $imageRoute = $_POST['imageRoute'] ?? null;
                }

                $excursion = $this->clean();
                $excursion->__set('id', $_POST['id']);
                $excursion->__set('nombre', $_POST['nombre']);
                $excursion->__set('categoria', $_POST['categoria']);
                $excursion->__set('fecha_inicio', $_POST['fecha_inicio']);
                $excursion->__set('duracion', $_POST['duracion']);
                $excursion->__set('precio', $_POST['precio']);
                $excursion->__set('descripcion', $_POST['descripcion']);
                $excursion->__set('imageRoute', $imageRoute);
                if ($this->model->update($excursion)) {
                    header('Location:index.php?app=excursion&action=index');
                } else {
                    echo "Error al actualizar la excursión.";
                }
            } catch (Exception $err) {
                $msg = new RedirectWithMessage(
                    false,
                    "Error inesperado",
                    "Hubo un error inesperado. Intenta nuevamente.",
                    "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
                );
                echo "Error: " . $err->getMessage();
            }
        } else {
            $msg = new RedirectWithMessage();
            $msg->redirectWithMessage(
                false,
                "Error: Método no permitido",
                "Solo mediante el método POST",
                "index.php?app=excursion&action=index"
            );
        }
    }
    public function handleImageUpload($image)
    {
        $uploadDir = './assets/images/uploads/excursions/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if ($image['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $image['tmp_name'];
            $fileName = $image['name'];
            $tempFileName = uniqid('excursion_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            $destPath = $uploadDir . $tempFileName;
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                return $tempFileName; 
            } else {
                throw new Exception('Error al subir la imagen');
            }
        } else {
            throw new Exception('Error en la carga de la imagen');
        }
    }
}
?>