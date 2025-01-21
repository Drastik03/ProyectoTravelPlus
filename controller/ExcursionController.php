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
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
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
                        $msg = new RedirectWithMessage(
                            true,
                            "Excursión registrada con éxito",
                            "La excursión ha sido registrada con éxito.",
                            "index.php?app=excursion&action=view_new"
                        );
                        //header('Location:index.php?app=excursion&action=index');
                    } else {
                        $msg = new RedirectWithMessage(
                            false,
                            "Error al registrar la excursión",
                            "Hubo un error al registrar la excursión. Intenta nuevamente.",
                            "index.php?app=excursion&action=view_new"
                        );
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
        if (isset($_FILES['image'])) {
            $excursion->__set('imageRoute', $_FILES['image']['name']);
        }
        $excursion->__set('price', htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8'));
        $excursion->__set('duration', htmlspecialchars($_POST['duracion'], ENT_QUOTES, 'UTF-8'));
        $excursion->__set('start_date', htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8'));
        return $excursion;
    }
    // Método para ver la edición
    public function view_edit()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id']; // Obtener el ID de la excursión desde la URL
        $excursion = $this->model->getExcursionById($id); // Obtener la excursión por ID
        
        // Verifica si los datos fueron obtenidos correctamente
        if ($excursion) {
            // Obtener las categorías para el dropdown
            $modelCategory = new CategoryDao();
            $categorias = $modelCategory->getAllCategory();

            // Pasar la excursión y las categorías a la vista
            require './view/excursions/excursions.edit.php'; 
        } else {
            echo "No se encontró la excursión."; // Verifica si la excursión existe
            $msg = new RedirectWithMessage(
                false,
                "Excursión no encontrada",
                "No se encontró la excursión que intentas editar.",
                "index.php?app=excursion&action=index"
            );
            $msg->redirectWithMessage();
        }
    } else {
        // Si no se proporciona el ID, redirigir a la lista de excursiones
        $msg = new RedirectWithMessage(
            false,
            "Error: ID faltante",
            "El ID de la excursión es obligatorio.",
            "index.php?app=excursion&action=index"
        );
        $msg->redirectWithMessage();
    }
}

public function edit()
{
    // Verificar si el método de la solicitud es POST
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
        // Verificar si los campos obligatorios están vacíos
        if (empty($_POST['nombre']) || empty($_POST['categoria']) || empty($_POST['fecha_inicio']) || empty($_POST['descripcion'])) {
            $msg = new RedirectWithMessage(
                false,
                "Error: Campos faltantes",
                "Por favor, complete todos los campos requeridos.",
                "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
            );
            $msg->redirectWithMessage();
            return;
        }

        // Limpiar y obtener los datos de la excursión
        $excursion = $this->clean(); // Asegúrate de que este método esté funcionando correctamente

        // Verificar si se subió una nueva imagen
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileType = $_FILES['image']['type'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($fileType, $allowedTypes)) {
                // Subir la imagen
                $uploadDir = './assets/images/uploads/excursions/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $tempFileName = uniqid('excursion_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destPath = $uploadDir . $tempFileName;

                // Mover la imagen a la carpeta de destino
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $excursion->__set('imageRoute', $tempFileName); // Actualizar la ruta de la imagen
                }
            } else {
                $msg = new RedirectWithMessage(
                    false,
                    "Error en la imagen",
                    "El archivo subido no es una imagen válida.",
                    "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
                );
                $msg->redirectWithMessage();
                return;
            }
        }

        // Actualizar la excursión en la base de datos
        if ($this->model->update($excursion)) {
            $msg = new RedirectWithMessage(
                true,
                "Excursión actualizada con éxito",
                "La excursión ha sido actualizada correctamente.",
                "index.php?app=excursion&action=index"
            );
            $msg->redirectWithMessage();
        } else {
            $msg = new RedirectWithMessage(
                false,
                "Error al actualizar la excursión",
                "Hubo un error al actualizar la excursión. Intenta nuevamente.",
                "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
            );
            $msg->redirectWithMessage();
        }
    } catch (Exception $err) {
        // Manejo de errores
        $msg = new RedirectWithMessage(
            false,
            "Error inesperado",
            "Hubo un error inesperado. Intenta nuevamente.",
            "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
        );
        $msg->redirectWithMessage();
        echo "Error: " . $err->getMessage();
    }
}



    // Eliminar una excursión
    public function delete_exursion()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
        $msg = new RedirectWithMessage(
            false,
            "Error al eliminar la excursión",
            "No se ha proporcionado un ID válido para la excursión.",
            "index.php?app=excursion&action=index"
        );
        $msg->redirectWithMessage();
        return; 
    }

    try {
        // Step 1: Retrieve the image path associated with the excursion
        $excursion = $this->model->getExcursionById($id);
        if ($excursion) {
            $imageRoute = $excursion['imageRoute'];  // Assuming 'imageRoute' is the column name storing the image path
            $imagePath = './assets/images/uploads/excursions/' . $imageRoute;  // Full path to the image file
            if (file_exists($imagePath)) {
                unlink($imagePath);  // Delete the image file from the server
            }
        }

        $deleted = $this->model->delete($id);
        if ($deleted) {
            $msg = new RedirectWithMessage(
                true,
                "Excursión eliminada con éxito",
                "La excursión ha sido eliminada correctamente.",
                "index.php?app=excursion&action=index"
            );
            $msg->redirectWithMessage();
        } else {
            $msg = new RedirectWithMessage(
                false,
                "Error al eliminar la excursión",
                "Hubo un error al eliminar la excursión. Intenta nuevamente.",
                "index.php?app=excursion&action=index"
            );
            $msg->redirectWithMessage();
        }
    } catch (Exception $err) {
        $msg = new RedirectWithMessage(
            false,
            "Error inesperado",
            "Hubo un error inesperado. Intenta nuevamente.",
            "index.php?app=excursion&action=index"
        );
        $msg->redirectWithMessage();
        echo "Error: " . $err->getMessage() . $err->getFile();
    }
}

    

}
?>