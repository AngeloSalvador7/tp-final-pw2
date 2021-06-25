<?php

class RegisterController
{
    private $render;
    private $employeeModel;


    public function __construct($employeeModel, $render)
    {
        $this->employeeModel = $employeeModel;
        $this->render = $render;
    }

    public function  execute(){
        echo $this->render->render("view/registerView.php");
    }

    public  function registerEmployee(){
        $result=$this->employeeModel->addEmployee($_POST);
        if($result) {
            header("Location: /register");
        }
        header("Location: /");
}
}