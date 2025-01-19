<?php
    //Ejemplo -> http://localhost/travelPlus?index.php?app=index&action=index
    require_once 'config/Config.php';
    //obtengo ruta o ruta por defecto
    $controller = (!empty($_REQUEST['app'])) ? htmlentities($_REQUEST['app']) : DEFAULT_CONTROLLER;
    $controller = ucwords(strtolower($controller)) . "Controller";
    $function = (!empty($_REQUEST['action'])) ? htmlentities($_REQUEST['action']) : DEFAULT_METHOD;
    require_once 'controller/' . $controller . '.php';
    $app = new $controller;
    $app->$function();
?>