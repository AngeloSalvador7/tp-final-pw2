<?php

class RegisterController extends SessionCheck
{
    private $render;
    private $empleadosModel;


    public function __construct($empleadosModel, $render)
    {
        parent::__construct("NINGUNO");
        $this->empleadosModel = $empleadosModel;
        $this->render = $render;
    }

    public function  execute()
    {
        echo $this->render->render("view/registerView.php");
    }

    public function registerEmployee()
    {
        $id = $this->empleadosModel->addEmployee($_POST);

        if ($id < 1) {
            header("Location: /register");
            exit();
        }

        Correo::enviarCorreo($_POST['email'], $this->empleadosModel->setHash($id, $_POST['email']));
        header("Location: /");
        exit();
    }

    public function validar(){
        if(empty($_GET['hash'])){
            header("location: /");
            exit();
        }

        if($this->empleadosModel->validarHash($_GET['hash'])){
            $_SESSION['mensaje'] = "Su usuario ha sido validado!";
            $_SESSION['tipoMensaje'] = "success";
        }else{
            $_SESSION['mensaje'] = "Link de validación invalido!";
            $_SESSION['tipoMensaje'] = "danger";
        }

        header("location: /");
        exit();
    }
}
