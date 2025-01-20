<?php
class CategoryController{
    private $model;
    public function __construct()
    {
        $this->model = new CategoryDao();
    }
}

?>