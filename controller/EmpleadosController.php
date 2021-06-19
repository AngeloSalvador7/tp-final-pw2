<?php

class EmpleadosController
{
    private $render;
    private $empleadosModel;

    public function __construct($render, $empleadosModel)
    {
        $this->render = $render;
        $this->empleadosModel = $empleadosModel;
    }

    public function execute()
    {
        $this->validarSesion();
        $datos['empleados'] = $this->empleadosModel->getEmpleados();
        echo $this->render->render("view/empleados.php", $datos);
    }

    public function nuevosEmpleados()
    {
        $this->validarSesion();
        $datos['empleados'] = $this->empleadosModel->getNuevosEmpleados();
        $datos['roles'] = $this->empleadosModel->getRol();

        if(isset($_SESSION['mensaje'])) {
            $datos['mensaje'] = $_SESSION['mensaje'];
            unset( $_SESSION['mensaje']);
        }
        
        echo $this->render->render("view/empleados.php", $datos);
    }

    public function asignarRol(){
        $this->validarSesion();
        if (!empty($_POST['rol']) && !empty($_POST['empleado'])) {
            if ($this->empleadosModel->asignarRol($_POST)) {
                $_SESSION['mensaje'] = "Nuevo usuario validado";
            } else {
                $_SESSION['mensaje'] = "No se pudo asignar rol al usuario";
            }
        }

        header('location: nuevosEmpleados');
        exit();
    }

    private function validarSesion(){
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['descripcion'] != "ADMINISTRADOR") {
            header('location: http://localhost/home');
            exit();
        }
    }
}