<?php
//AUTOR: ARIEL ALBERTO SOLIS PINO
class User{
    private $id;
    private $rol_id;
    private $name, $lastName;
    private $username;
    private $password;
    function __construct(){}
    public function __set($name, $value) {
        if (property_exists('User', $name)) {
            $this->$name = $value;
        } else {
            echo $name . " Esta propiedad no existe.";
        }
    }
    public function __get($name) {
        if (property_exists('User', $name)) {
            return $this->$name;
        } 
        return null;
    }
}
?>