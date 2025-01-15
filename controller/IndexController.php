<?php
class IndexController{
    public function index(){
        if(!empty($_GET['p'])){
            $page = $_GET['p'];
            require_once 'view/static/'.$page.'.php';
        }else{
            require_once 'view/HomeView.php';
        }
    }
}
?>