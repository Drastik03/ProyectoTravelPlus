<?php
class Excursion
{
    private $id;
    private $title, $description;
    private $price, $duration;
    private $imageRoute;
    private $category_id;
    private $start_date;
    function __construct() {}
    public function __set($name, $value)
    {
        if (property_exists('Excursion', $name)) { 
            $this->$name = $value;
        } else {
            echo $name . " Esta propiedad no existe.";
        }
    }
    public function __get($name)
    {
        if (property_exists('Excursion', $name)) { 
            return $this->$name;
        }
        return null;
    }
}

?>