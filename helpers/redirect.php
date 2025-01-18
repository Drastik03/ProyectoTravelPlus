<?php
class RedirectWithMessage {
    public function redirectWithMessage($exito, $mensajeExito, $mensajeError, $url)
    {
        if ($exito) {
            $_SESSION['mensaje'] = $mensajeExito;
            $_SESSION['color'] = 'success';
        } else {
            $_SESSION['mensaje'] = $mensajeError;
            $_SESSION['color'] = 'danger';
        }
    
        header("Location: $url");
        exit;
    }
}

?>
