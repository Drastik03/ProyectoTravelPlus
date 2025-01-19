<?php
//AUTHOR: VEAS NOBOA JOHAN DAVID

class Excursion
{
    private $id;
    private $title, $description;
    private $price, $duration;
    private $imageRoute;
    private $dificult, $category;
    function __construct() {}
    public function __set($name, $value)
    {
        if (property_exists('User', $name)) {
            $this->$name = $value;
        } else {
            echo $name . " Esta propiedad no existe.";
        }
    }
    public function __get($name)
    {
        if (property_exists('User', $name)) {
            return $this->$name;
        }
        return null;
    }
}
?>