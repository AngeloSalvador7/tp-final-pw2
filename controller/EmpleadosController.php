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
        if(isset($_POST['msg']))
            $datos['mensaje'] = $_POST['msg'];
        $datos['empleadosSinRol'] = true;

        echo $this->render->render("view/empleados.php", $datos);
    }

    public function empleadosSinRol()
    {
        $this->validarSesion();
        $datos['empleados'] = $this->empleadosModel->getEmpleadosSinRol();
        $datos['roles'] = $this->empleadosModel->getRol();
        $datos['empleadosSinRol'] = false;

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

    public function eliminarEmpleado(){
        $this->validarSesion();
        if( $this->empleadosModel->eliminarEmpleado($_POST['eliminar_id'])){
            $_POST['msg'] = "Se elimino el usuario";
            $this->execute();
        } else {
            $_POST['msg'] = "No se elimino el usuario";
        }
    }

    public function editarEmpleados(){
        $this->validarSesion();
        $datos['empleado'] = $this->empleadosModel->getEmpleadosById($_POST['editar_id']);
        $datos['roles'] = $this->empleadosModel->getRol();

        echo $this->render->render("view/editarEmpleados.php", $datos);
    }

   /* public function editarEmpleadosSinRol(){
        $this->validarSesion();
        $datos['empleados'] = $this->empleadosModel->getEmpleadosByIdSinRol($_POST['editar_id']);
        $datos['roles'] = $this->empleadosModel->getRol();

        echo $this->render->render("view/editarEmpleadosSinRol.php", $datos);
    }*/

    public function guardarCambios(){
        $this->validarSesion();
        if($this->empleadosModel->actualizarEmpleado($_POST)){
            $_POST['msg'] = "Se actualizaron los datos";
        }else{
            $_POST['msg'] = "No se actualizaron los datos";
        }
        $this->execute();
    }

    private function validarSesion(){
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['descripcion'] != "ADMINISTRADOR") {
            header('location: http://localhost/home');
            exit();
        }
    }

}