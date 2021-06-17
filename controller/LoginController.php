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
        $result = $this->employeeModel->loginEmployee($_POST);
        if ($result) {
            $_SESSION['usuario'] = $result[0];
            header("Location: /home");
        } else {
            header("Location: /login");
        }
    }
}