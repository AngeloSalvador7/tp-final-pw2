<?php

class LogoutController{

    private $render;

    public function __construct ($render){
        $this->render= $render;
    }

    public function  execute(){
        session_destroy();
        header('location: /');
    }
}
