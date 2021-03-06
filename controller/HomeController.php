<?php

class HomeController
{
    private $render;
    private $HomeModel;

    public function __construct($render, $HomeModel)
    {
        $this->render = $render;
        $this->HomeModel = $HomeModel;
    }

    public function execute()
    {
        $this->loginUserView();
    }

    public function loginUserView()
    {
        if(!$_SESSION['usuario']){
            header("Location: /");
            exit();
        }

        $data['usuario']=$_SESSION['usuario'];

        switch($data['usuario']['id_rol']) {
            case 1:
                header('location: /empleados');
                break;
            case 2:
                header('location: /chofer');
                break;
            case 3:
                header('location: /proformas');
                break;
            case 4:
                header('location: /mecanico');
                break;
            default;
                echo $this->render->render("view/homeSinRolView.php", $data);
                break;
        }
    }

}