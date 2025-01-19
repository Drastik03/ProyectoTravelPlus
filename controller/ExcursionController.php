<?php
require_once './model/dao/ExcursionDao.php';
require_once './model/dao/ExcursionDao.php';

class ExcursionController{
    private $model;
    public function __construct(){
        $this->model = new ExcursionDao();
    }
    public function index(){
        require_once './view/excursions/excursions.list.php';
    }
}

?>