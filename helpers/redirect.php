<?php
class RedirectWithMessage {
    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
        exit();
    }
}

?>
