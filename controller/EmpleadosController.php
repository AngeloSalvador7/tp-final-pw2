<?php

class EmpleadosController extends SessionCheck
{
    private $render;
    private $empleadosModel;

    public function __construct($render, $empleadosModel)
    {
        parent::__construct("ADMINISTRADOR");
        $this->render = $render;
        $this->empleadosModel = $empleadosModel;
    }

    public function execute()
    {
        $datos['empleados'] = $this->empleadosModel->getEmpleados();
        echo $this->render->render("view/empleadosView.php", $datos);
    }

    public function nuevosEmpleados()
    {
        $datos['empleados'] = $this->empleadosModel->getNuevosEmpleados();
        $datos['roles'] = $this->empleadosModel->getRol();

        if(isset($_SESSION['mensaje'])) {
            $datos['mensaje'] = $_SESSION['mensaje'];
            unset( $_SESSION['mensaje']);
        }
        
        echo $this->render->render("view/empleadosView.php", $datos);
    }

    public function asignarRol(){
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

}