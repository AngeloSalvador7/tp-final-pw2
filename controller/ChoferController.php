<?php

class ChoferController extends SessionCheck
{
    private $render;
    private $choferModel;

    public function __construct($render, $choferModel){
        parent::__construct("CHOFER");
        $this->render = $render;
        $this-> choferModel = $choferModel;

    }

    public function execute(){
        if(isset($_SESSION['msg'])) {
            $datos['mensaje'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if(empty($this->choferModel->tieneLicencia($_SESSION['usuario']['id']))){
            $datos['completarLicencia'] = $_SESSION['usuario']['id'];
        }else {
            $datos['editarLicencia'] = $this->choferModel->getChoferById($_SESSION['usuario']['id']);
        }
        echo $this->render->render("view/homeChoferView.php", $datos);
    }

    public function agregarLicencia(){
        $_SESSION['msg'] = "Se guardó la licencia";
        $this->choferModel->agregarLicencia($_POST);

        header('location:/chofer');
        exit();
    }

    public function editarLicencia(){
        if($this->choferModel->editarLicencia($_POST) > 0){
            $_SESSION['msg'] = "Se actualizó la licencia";
        }

        header('location:/chofer');
        exit();

    }
}