<?php
//AUTHOR: ZAMBRANO RODRIGUEZ ANGEL DANIEL
require_once './model/dao/AlojamientoDao.php';
require_once './model/dto/Excursion.php';
require_once './model/dao/CategoryDao.php';
require_once './helpers/redirect.php';
require_once './model/dto/CreateCommentDTO.php';
require_once './model/dto/CreateAlojamientoDTO.php';
class AlojamientoController
{
    private $model;
    public function __construct()
    {
        $this->model = new AlojamientoDAO();
    }
    public function index()
    {

        $alojamientos = $this->model->all();
        require_once './view/alojamientos/index.php';
    }
    public function show(){
        //tomar queryParam  id
        $alojamiento_id = $_GET['id'];
        if(!$alojamiento_id){
            echo "<h1>404 \n NOT FOUND</h1>";
            return;
        }

        $alojamiento = $this->model->getById($alojamiento_id);
        $comentarios = $this->model->getCommentsByAlojamientoId($alojamiento_id);
        if(!$alojamiento){
            echo "<h1>404 \n NOT FOUND</h1>";
            return;
        }
        require_once './view/alojamientos/show.php';
    }
    public function edit (){
        $alojamiento_id = $_GET['id'];
        if(!$alojamiento_id){
            echo "<h1>404 \n NOT FOUND</h1>";
            return;
        }
        $alojamiento = $this->model->getById($alojamiento_id);
        if(!$alojamiento){
            require_once './view/alojamientos/index.php';
        }
        require_once './view/alojamientos/update.php';
    }
    public function create_comment(){
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
        try{
            $comment = new CreateCommentDTO();
            $comment->setAlojamiento_id(htmlentities($_POST['alojamiento_id'], ENT_QUOTES, 'UTF-8'));
            $comment->setComment(htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8'));
            $comment->setScore(htmlentities($_POST['rate'], ENT_QUOTES, 'UTF-8'));
            $comment->setUser_id($_SESSION['id']);
            if($this->model->save_comment($comment)){
                header('Location:index?app=alojamiento&action=show&id=' .$_POST['alojamiento_id']);
               
            }else{
                echo "Error al registrar el comentario.";
            }

        }catch(Exception $e){
            $msg = new RedirectWithMessage(
                false,
                "Error inesperado",
                "Hubo un error inesperado. Intenta nuevamente.",
                "index.php?app=excursion&action=view_new"
            );
            echo "Error: " . $e->getMessage();
        }
    }

    public function search(){
        $param = htmlentities($_GET['search'] ?? "");
        try{
            $alojamientos = $this->model->search($param);
            require_once './view/alojamientos/index.php';
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
    public function create(){
        require_once './view/alojamientos/create.php';
    }
    public function store(){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $msg = new RedirectWithMessage();
            $msg->redirectWithMessage(
                false,
                "Error: Método no permitido",
                "Solo mediante el método POST",
                "index.php?app=alojamiento&action=index"
            );
            return;
        }
        try{
            $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
            $descripcion = htmlentities($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
            $ubicacion = htmlentities($_POST['ubicacion'], ENT_QUOTES, 'UTF-8');
            $tipo = htmlentities($_POST['tipo'], ENT_QUOTES, 'UTF-8');
            $precio = htmlentities($_POST['precio'], ENT_QUOTES, 'UTF-8');
            $capacidad = htmlentities($_POST['capacidad'], ENT_QUOTES, 'UTF-8');
            $disponible = htmlentities($_POST['disponible'], ENT_QUOTES, 'UTF-8');
            $foto = $_FILES['foto'];
            $foto_base64 = base64_encode(file_get_contents($foto['tmp_name']));
            $foto_base64 = 'data:image/' . pathinfo($foto['name'], PATHINFO_EXTENSION) . ';base64,' . $foto_base64;
            $alojamiento = new CreateAlojamientoDTO();
            $alojamiento->setNombre($nombre);
            $alojamiento->setDescripcion($descripcion);
            $alojamiento->setUbicacion($ubicacion);
            $alojamiento->setTipo($tipo);
            $alojamiento->setPrecio($precio);
            $alojamiento->setCapacidad($capacidad);
            $alojamiento->setDisponible($disponible);
            $alojamiento->setBase_64($foto_base64);
            $result = $this->model->save($alojamiento);
            if($result){
                $msg = new RedirectWithMessage();
                $msg->redirectWithMessage(
                    true,
                    "Alojamiento creado",
                    "El alojamiento se ha creado correctamente",
                    "index.php?app=alojamiento&action=index"
                );
            }else{
                $msg = new RedirectWithMessage();
                $msg->redirectWithMessage(
                    false,
                    "Error al crear alojamiento",
                    "Hubo un error al intentar crear el alojamiento",
                    "index.php?app=alojamiento&action=create"
                );
            }
        }catch(Exception $e){
            $msg = new RedirectWithMessage();
            $msg->redirectWithMessage(
                false,
                "Error inesperado",
                "Hubo un error inesperado. Intenta nuevamente.",
                "index.php?app=alojamiento&action=create"
            );
            echo "Error: " . $e->getMessage();
        }
       


    }
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
            parse_str(file_get_contents("php://input"), $_PUT);
    
            $id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
            $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
            $descripcion = htmlentities($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
            $ubicacion = htmlentities($_POST['ubicacion'], ENT_QUOTES, 'UTF-8');
            $tipo = htmlentities($_POST['tipo'], ENT_QUOTES, 'UTF-8');
            $precio = htmlentities($_POST['precio'], ENT_QUOTES, 'UTF-8');
            $capacidad = htmlentities($_POST['capacidad'], ENT_QUOTES, 'UTF-8');
            $disponible = htmlentities($_POST['disponible'], ENT_QUOTES, 'UTF-8');
            $foto_base64 = htmlentities($_POST['foto_base64'], ENT_QUOTES, 'UTF-8');
    
            // Crear un DTO para el alojamiento
            $alojamientoDTO = new CreateAlojamientoDTO();
            $alojamientoDTO->setId($id);
            $alojamientoDTO->setNombre($nombre);
            $alojamientoDTO->setDescripcion($descripcion);
            $alojamientoDTO->setUbicacion($ubicacion);
            $alojamientoDTO->setTipo($tipo);
            $alojamientoDTO->setPrecio($precio);
            $alojamientoDTO->setCapacidad($capacidad);
            $alojamientoDTO->setDisponible($disponible);
            $alojamientoDTO->setBase_64($foto_base64);
    
            // Actualizar el alojamiento en la base de datos
            $this->model->update($alojamientoDTO);
    
            // Redirigir a la página de detalles del alojamiento
            header("Location: index.php?app=alojamiento&action=index");
        } else {
            // Manejar el caso en que la petición no sea PUT
            echo "Método no permitido";
        }
    }
    
 
    
}
?>