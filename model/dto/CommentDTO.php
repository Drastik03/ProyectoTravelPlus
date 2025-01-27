<?php
class CommentDTO {
    public $alojamiento_id;
    public $comentario;
    public $score;
    public $fecha_creacion;
    public $user_id;

    public function __construct($alojamiento_id = null, $comentario = "", $score = 0, $fecha_creacion = "", $user_id = "") {
        $this->alojamiento_id = $alojamiento_id;
        $this->comentario = $comentario;
        $this->score = $score;
        $this->fecha_creacion = $fecha_creacion;
        $this->user_id = $user_id;
    }
}


?>