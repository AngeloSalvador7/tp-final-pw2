<?php

class RegisterController extends SessionCheck
{
    private $render;
    private $employeeModel;


    public function __construct($employeeModel, $render)
    {
        parent::__construct("NINGUNO");
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