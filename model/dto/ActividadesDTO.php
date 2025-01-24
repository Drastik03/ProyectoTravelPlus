<?php
//AUTHOR: Santacruz Salas Jostin Fabricio
class ActividadDTO {
    public $id;
    public $nombre_actividad;
    public $descripcion;
    public $ubicacion;
    public $hora;
    public $precio;
    public $imagen;
    public $fecha_creacion;
    public $fecha_actualizacion;
    public $usuario_actualizacion;

    public function __construct($id = null, $nombre_actividad = "", $descripcion = "", $ubicacion = "", $hora = "", $precio = 0, $imagen = "", $fecha_creacion = "", $fecha_actualizacion = "", $usuario_actualizacion = "") {
        $this->id = $id;
        $this->nombre_actividad = $nombre_actividad;
        $this->descripcion = $descripcion;
        $this->ubicacion = $ubicacion;
        $this->hora = $hora;
        $this->precio = $precio;
        $this->imagen = $imagen;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_actualizacion = $fecha_actualizacion;
        $this->usuario_actualizacion = $usuario_actualizacion;
    }
}
?>
