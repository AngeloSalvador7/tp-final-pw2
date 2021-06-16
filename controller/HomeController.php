<?php
class HomeController
{
    private $render;
    private $HomeModel;

    public function __construct($render,$HomeModel){
        $this->render = $render;
        $this->HomeModel = $HomeModel;
    }

    public function execute(){
        $data = $_SESSION["usuario"];
        echo $this->render->render("view/homeView.php",$data);
    }

}