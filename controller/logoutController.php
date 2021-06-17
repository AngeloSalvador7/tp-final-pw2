<?php

class logoutController{

    private $render;

    public function __construct ($render){
        $this->render= $render;
    }

    public function  execute(){
        session_destroy();
        echo $this->render->render("view/loginView.php");
    }
}
