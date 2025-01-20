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
}
?>