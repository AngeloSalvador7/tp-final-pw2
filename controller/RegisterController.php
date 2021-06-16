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
   $this->employeeModel->addEmployee($_POST["dni"],$_POST["fecha_nacimiento"],$_POST["nombre"],$_POST["apellido"],$_POST["email"],$_POST["clave"]);
          header ("Location: /pw2");
}}