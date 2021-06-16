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

    public function validateEmployee()
    {
        $result = $this->employeeModel->loginEmployee($_POST["email"],$_POST["clave"]);
        if($result) {
            $_SESSION['usuario'] = array("email" => [0]["email"]);
        }
        header("Location: /tp-final-pw2/home");

    }
}