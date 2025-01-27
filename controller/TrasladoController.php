<?php
// AUTHOR: MOSQUERA VERGARA GEORGE ARIEL
require_once './model/dao/TrasladoDao.php';
require_once './model/dto/Traslado.php';
require_once './model/dao/CategoryDao.php';
require_once './helpers/redirect.php';

class TrasladoController
{
    private $model;

    public function __construct()
    {
        $this->model = new TrasladoDao();
    }

    public function index()
    {
        require_once './view/traslados/traslados.new.php'; // Muestra el formulario de nuevo traslado
    }

    public function view_new()
    { 
       

        $traslados = $this->model->getTraslados();
        require_once './view/traslados/traslados.list.php'; // Cambié a .list.php para mostrar la lista
    }

    public function view_edit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $traslado = $this->model->getTrasladoById($id);
            if ($traslado) {
                require './view/traslados/traslados.edit.php'; // Muestra el formulario de edición
            } else {
                $this->redirectWithMessage(false, "Traslado no encontrado", "No se encontró el traslado que intentas editar.", "index.php?app=traslado&action=index");
            }
        } else {
            $this->redirectWithMessage(false, "Error: ID faltante", "El ID del traslado es obligatorio.", "index.php?app=traslado&action=index");
        }
    }

    
    public function register_traslado()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithMessage(false, "Error: Método no permitido", "Solo mediante el método POST", "index.php?app=traslado&action=index");
            return;
        }
    
        // Validación de campos vacíos
        $missingFields = [];
        if (empty($_POST['origen'])) $missingFields[] = 'Origen';
        if (empty($_POST['destino'])) $missingFields[] = 'Destino';
        if (empty($_POST['fecha_recogida'])) $missingFields[] = 'Fecha de Recogida';
        if (empty($_POST['hora_recogida'])) $missingFields[] = 'Hora de Recogida';
        if (empty($_POST['cantidad_pasajeros'])) $missingFields[] = 'Cantidad de Pasajeros';
        if (empty($_POST['precio'])) $missingFields[] = 'Precio';
    
        if (!empty($missingFields)) {
            $fields = implode(', ', $missingFields);
            $this->redirectWithMessage(false, "Error: Campos faltantes", "Por favor, complete los siguientes campos: $fields.", "index.php?app=traslado&action=view_new");
            return;
        }
    
        // Intentar registrar el traslado
        try {
            $traslado = $this->clean();  // Limpieza y preparación de datos
    
            // Verificar si se insertó correctamente en la base de datos
            if ($this->model->insert($traslado)) {
                // Mensaje de éxito al registrar el traslado
                $this->redirectWithMessage(true, "Éxito", "El traslado se registró correctamente.", "index.php?app=traslado&action=index");
            } else {
                // Mensaje de error si no se pudo insertar el traslado
                $this->redirectWithMessage(false, "Error al registrar el traslado", "Intenta nuevamente.", "index.php?app=traslado&action=view_new");
            }
        } catch (Exception $err) {
            // Captura de excepciones y mensaje de error
            $this->redirectWithMessage(false, "Error inesperado", "Hubo un error inesperado. Intenta nuevamente.", "index.php?app=traslado&action=view_new");
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Limpia y prepara los datos del traslado
                $traslado = $this->clean();
                $traslado->setId(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)); // Usar el método setter para el ID
    
                // Validar que los campos requeridos no sean nulos
                $origen = filter_input(INPUT_POST, 'origen', FILTER_SANITIZE_STRING);
                $destino = filter_input(INPUT_POST, 'destino', FILTER_SANITIZE_STRING);
                $fecha_recogida = filter_input(INPUT_POST, 'fecha_recogida', FILTER_SANITIZE_STRING);
                $hora_recogida = filter_input(INPUT_POST, 'hora_recogida', FILTER_SANITIZE_STRING);
                $cantidad_pasajeros = filter_input(INPUT_POST, 'cantidad_pasajeros', FILTER_VALIDATE_INT);
                $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
    
                // Comprobar si alguno de los campos requeridos está vacío o nulo
                if (empty($origen) || empty($destino) || empty($fecha_recogida) || empty($hora_recogida) || 
                    is_null($cantidad_pasajeros) || is_null($precio)) {
                    $this->redirectWithMessage(false, "Error: Campos requeridos", "Todos los campos son obligatorios.", "index.php?app=traslado&action=view_edit&id=" . $traslado->getId());
                    return; // Salir del método si hay un error
                }
    
                // Validar que cantidad de pasajeros y precio sean mayores a 0
                if ($cantidad_pasajeros <= 0) {
                    $this->redirectWithMessage(false, "Error: Cantidad de Pasajeros", "La cantidad de pasajeros debe ser mayor a 0.", "index.php?app=traslado&action=view_edit&id=" . $traslado->getId());
                    return; // Salir del método si hay un error
                }
    
                if ($precio <= 0) {
                    $this->redirectWithMessage(false, "Error: Precio", "El precio debe ser mayor a 0.", "index.php?app=traslado&action=view_edit&id=" . $traslado->getId());
                    return; // Salir del método si hay un error
                }
    
                // Asignar los valores validados al objeto traslado
                $traslado->setOrigen($origen);
                $traslado->setDestino($destino);
                $traslado->setFechaRecogida($fecha_recogida);
                $traslado->setHoraRecogida($hora_recogida);
                $traslado->setCantidadPasajeros($cantidad_pasajeros);
                $traslado->setPrecio($precio);
    
                // Intenta actualizar el traslado en la base de datos
                if ($this->model->update($traslado)) {
                    $this->redirectWithMessage(true, "Éxito", "El traslado se actualizó correctamente.", "index.php?app=traslado&action=index");
                } else {
                    $this->redirectWithMessage(false, "Error al actualizar el traslado.", "Intenta nuevamente.", "index.php?app=traslado&action=view_edit&id=" . $traslado->getId());
                }
            } catch (Exception $err) {
                $this->redirectWithMessage(false, "Error inesperado", "Hubo un error inesperado. Intenta nuevamente.", "index.php?app=traslado&action=view_edit&id=" . $_POST['id']);
            }
        } else {
            $this->redirectWithMessage(false, "Error: Método no permitido", "Solo mediante el método POST", "index.php?app=traslado&action=index");
        }
    }

    private function clean()
    {
        $id = 0; 
        $origen = filter_input(INPUT_POST, 'origen', FILTER_SANITIZE_STRING);
        $destino = filter_input(INPUT_POST, 'destino', FILTER_SANITIZE_STRING);
        $fecha_recogida = filter_input(INPUT_POST, 'fecha_recogida', FILTER_SANITIZE_STRING);
        $hora_recogida = filter_input(INPUT_POST, 'hora_recogida', FILTER_SANITIZE_STRING);
        $cantidad_pasajeros = filter_input(INPUT_POST, 'cantidad_pasajeros', FILTER_VALIDATE_INT);
        $precio = filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_STRING);

        // Crea un nuevo objeto Traslado con todos los parámetros
        return new Traslado($id, $origen, $destino, $fecha_recogida, $hora_recogida, $cantidad_pasajeros, $precio);
    }

    public function search()
{
    $parametro = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    $traslados = $this->model->selectAll($parametro); 
    require_once './view/traslados/traslados.list.php'; 
}

    public function delete_traslado()
     {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        $this->redirectWithMessage(false, "Error: ID faltante", "No se ha proporcionado un ID válido para el traslado.", "index.php?app=traslado&action=index");
        return;
    }try {
        $traslado = $this->model->getTrasladoById($id);
        if ($traslado) {
            if ($this->model->delete($id)) {
                $this->redirectWithMessage(true, "Traslado eliminado con éxito", "", "index.php?app=traslado&action=index");
            } else {
                $this->redirectWithMessage(false, "Error al eliminar el traslado.", "Intenta nuevamente.", "index.php?app=traslado&action=index");
            }
        } else {
            $this->redirectWithMessage(false, "No se encontró el traslado.", "", "index.php?app=traslado&action=index");
        }
    } catch (Exception $err) {
        $this->redirectWithMessage(false, "Error inesperado", "Hubo un error inesperado. Intenta nuevamente.", "index.php?app=traslado&action=index");
    }
    }

    // Método para redirigir con mensaje
    private function redirectWithMessage($success, $title, $message, $redirectUrl)
    {
        $redirect = new RedirectWithMessage();
        $redirect->redirectWithMessage($success, $title, $message, $redirectUrl);
    }
}
?>