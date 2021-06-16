<?php

class LoginController
{
    private $render;
    private $employeeModel;

    public function __construct($render, $employeeModel)
    {
        $this->render = $render;
        $this->employeeModel = $employeeModel;
    }

    public function execute()
    {
        echo $this->render->render("view/loginView.php");
    }

    public function validar()
    {
        $email = $_POST["email"];
        $clave = $_POST["clave"];
        $result = $this->employeeModel->loginEmployee($email, $clave);
        if (empty($result[0])) {
            header("Location:/tp-final-pw2");
            exit();
        } else {
            $_SESSION['USUARIO'] = array('email' => $result[0]['email']);

            header("Location:/tp-final-pw2/homeView");
            exit();
        }

    }


}