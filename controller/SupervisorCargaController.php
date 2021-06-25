<?php
class SupervisorCargaController
{
    private $render;
    private $cargasModel;

    public function __construct($render, $cargasModel)
    {
        $this->render = $render;
        $this->cargasModel = $cargasModel;
    }
    public function execute()
    {
        $this->CargasView();
    }

    private function CargasView()
    {
        if(!$_SESSION['usuario']){
            header("Location: /");
            exit();
        }

        $data['usuario']=$_SESSION['usuario'];
        $data['vistaCargas']=true;
        $data['cargas']=$this->cargasModel->getCargas();

        if (!$data['cargas']){
            $data['mensaje'] = "No hay cargas registradas";
        }

        echo $this->render->render("view/homeSupervisorView.php", $data);
    }

    public function agregarCarga()
    {
        $this->validarSesion();
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaAgregarCarga']=true;
        $data['arrastre']=$this->cargasModel->getArrastres();;

        echo $this->render->render("view/homeSupervisorView.php", $data);
    }
    public function insertarCarga()
    {
        $this->validarSesion();
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaCargas']=true;
        $this->cargasModel->agregarNuevaCarga($_POST);
        header('location: http://localhost/cargas');
        exit();
    }
    public function editarCarga()
    {
        $this->validarSesion();
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaModificarCarga']=true;
        $data['cargas']=$this->cargasModel->getCargas();
        $data['arrastre']=$this->cargasModel->getArrastres();;
        if (!$data['cargas']){
            $data['mensaje'] = "No hay cargas registradas";
        }
        echo $this->render->render("view/homeSupervisorView.php", $data);
    }
    public function borrarCarga()
    {
        $this->validarSesion();
        $this->cargasModel->dropCarga($_POST['borrar_id']);
        $this->editarCarga();
    }
    public function actualizarCarga()
    {
        $this->validarSesion();
        $this->cargasModel->actualizarCarga($_POST);
        $this->editarCarga();
    }

    public function modificarCarga()
    {
        $this->validarSesion();
        $data['vistaModificacionDeCarga']=true;
        $data['arrastre']=$this->cargasModel->getArrastres();;
        $data['carga']=$this->cargasModel->getUnicaCarga($_POST['modificar_id']);

        echo $this->render->render("view/homeSupervisorView.php", $data);
    }
    private function validarSesion(){
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['descripcion'] != "SUPERVISOR") {
            header('location: http://localhost/home');
            exit();
        }
    }
}