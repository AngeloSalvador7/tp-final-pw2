<?php

class LoginController extends SessionCheck
{
    private $render;
    private $employeeModel;

    public function __construct($render, $employeeModel)
    {
        parent::__construct("NINGUNO");
        $this->render = $render;
        $this->employeeModel = $employeeModel;
    }

    public function execute()
    {
        $datos = [];

        if (isset($_SESSION['mensaje']) && isset($_SESSION['tipoMensaje'])) {
            $datos['mensaje'] = $_SESSION['mensaje'];
            $datos['tipoMensaje'] = $_SESSION['tipoMensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipoMensaje']);
        }

        echo $this->render->render("view/loginView.php", $datos);
    }

    public function validateEmployee()
    {
        $result = $this->employeeModel->loginEmployee($_POST);
        if ($result) {
            $_SESSION['usuario'] = $result[0];
            header("Location: /home");
            exit();
        } else {
            header("Location: /");
            exit();
        }
    }
}