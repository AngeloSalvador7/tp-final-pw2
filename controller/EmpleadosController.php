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
        if(isset($_SESSION['msg'])) {
            $datos['mensaje'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $datos['empleadosSinRol'] = true;

        echo $this->render->render("view/empleadosView.php", $datos);

    }

    public function empleadosSinRol()
    {
        $datos['empleados'] = $this->empleadosModel->getEmpleadosSinRol();
        $datos['roles'] = $this->empleadosModel->getRol();
        $datos['empleadosSinRol'] = false;

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

    public function eliminarEmpleado(){
        if( $this->empleadosModel->eliminarEmpleado($_POST['eliminar_id'])){
            $_POST['msg'] = "Se elimino el usuario";
            $this->execute();
        } else {
            $_POST['msg'] = "No se elimino el usuario";
        }
    }

    public function editarEmpleados(){
        $datos['empleado'] = $this->empleadosModel->getEmpleadosById($_POST['editar_id']);
        $datos['roles'] = $this->empleadosModel->getRol();

        echo $this->render->render("view/editarEmpleados.php", $datos);
    }

    public function guardarCambios(){
        if($this->empleadosModel->actualizarEmpleado($_POST)){
            $_SESSION['msg'] = "Se actualizaron los datos";
        }else{
            $_SESSION['msg'] = "No se actualizaron los datos";
        }
        $this->execute();
    }

}