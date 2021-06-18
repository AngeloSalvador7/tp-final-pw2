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
        $this->vistaUsuarioLogueado();
    }

    public function vistaUsuarioLogueado()
    {
        if(!$_SESSION['usuario']){
            header("Location: /");
            exit();
        }

        $data['usuario']=$_SESSION['usuario'];

        switch($data['usuario']['id_rol']) {
            case 1:
                echo $this->render->render("view/homeAdminView.php", $data);
                break;
            case 2:
                echo $this->render->render("view/homeSupervisorView.php", $data);
                break;
            case 3:
                echo $this->render->render("view/homeChoferView.php", $data);
                break;
            case 4:
                echo $this->render->render("view/homeMecanicoView.php", $data);
                break;
            default;
                echo $this->render->render("view/homeSinRolView.php", $data);
        }
    }

}