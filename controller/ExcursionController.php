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
    public function view_edit()
    {
        $modelCategory = new CategoryDao();
        $categorias = $modelCategory->getAllCategory();
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $excursion = $this->model->getExcursionById($id);
            require_once './view/excursions/excursions.edit.php';
        } else {
            $msg = new RedirectWithMessage(
                false,
                "Error: Excursión no encontrada",
                "No se pudo encontrar la excursión que deseas editar.",
                "index.php?app=excursion&action=index"
            );
            return;
        }
    }
    // Editar una excursión
    public function edit_excursion()
{
    // Validar que sea una solicitud POST
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
        // Verificamos que todos los campos necesarios estén presentes en el POST
        if (empty($_POST['nombre']) || empty($_POST['categoria']) || empty($_POST['fecha_inicio']) || empty($_POST['descripcion'])) {
            $msg = new RedirectWithMessage(
                false,
                "Error: Campos faltantes",
                "Por favor, complete todos los campos requeridos.",
                "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
            );
            return;
        }

        $excursion = $this->clean(); // Limpiar los datos

        // Verificar si hay una imagen cargada
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileType = $_FILES['image']['type'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($fileType, $allowedTypes)) {
                $uploadDir = './assets/images/uploads/excursions/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $tempFileName = uniqid('excursion_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destPath = $uploadDir . $tempFileName;
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $excursion->__set('imageRoute', $tempFileName);
                }
            } else {
                $msg = new RedirectWithMessage(
                    false,
                    "Error en la imagen",
                    "El archivo subido no es una imagen válida.",
                    "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
                );
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
        } else {
            $msg = new RedirectWithMessage(
                false,
                "Error al actualizar la excursión",
                "Hubo un error al actualizar la excursión. Intenta nuevamente.",
                "index.php?app=excursion&action=view_edit&id=" . $_POST['id']
            );
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
}
    // Eliminar una excursión
    public function delete_exursion()
{
    // Obtener el id desde la URL
    $id = isset($_GET['id']) ? $_GET['id'] : null; // Asegurarse de que el id exista

    if (!$id) {
        // Si no hay id en la URL, mostramos un mensaje de error
        $msg = new RedirectWithMessage(
            false,
            "Error al eliminar la excursión",
            "No se ha proporcionado un ID válido para la excursión.",
            "index.php?app=excursion&action=index"
        );
        return; // Salir de la función
    }

    try {
        // Llamar al modelo para eliminar la excursión
        $deleted = $this->model->delete($id);

        if ($deleted) {
            // Si la eliminación es exitosa
            $msg = new RedirectWithMessage(
                true,
                "Excursión eliminada con éxito",
                "La excursión ha sido eliminada correctamente.",
                "index.php?app=excursion&action=index"
            );
        } else {
            // Si ocurre un error al eliminar
            $msg = new RedirectWithMessage(
                false,
                "Error al eliminar la excursión",
                "Hubo un error al eliminar la excursión. Intenta nuevamente.",
                "index.php?app=excursion&action=index"
            );
        }
    } catch (Exception $err) {
        // Capturar cualquier excepción inesperada
        $msg = new RedirectWithMessage(
            false,
            "Error inesperado",
            "Hubo un error inesperado. Intenta nuevamente.",
            "index.php?app=excursion&action=index"
        );
        echo "Error: " . $err->getMessage();
    }
}



}
?>