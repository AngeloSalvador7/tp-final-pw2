<?php
class SupervisorCargaController extends SessionCheck
{
    private $render;
    private $cargasModel;

    public function __construct($render, $cargasModel)
    {
        parent::__construct("SUPERVISOR");
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

        echo $this->render->render("view/cargaView.php", $data);
    }

    public function agregarCarga()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaAgregarCarga']=true;
        $data['arrastre']=$this->cargasModel->getArrastres();;

        echo $this->render->render("view/cargaView.php", $data);
    }
    public function insertarCarga()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaCargas']=true;
        $this->cargasModel->agregarNuevaCarga($_POST);
        header('location: http://localhost/cargas');
        exit();
    }
    public function editarCarga()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaModificarCarga']=true;
        $data['cargas']=$this->cargasModel->getCargas();
        $data['arrastre']=$this->cargasModel->getArrastres();;
        if (!$data['cargas']){
            $data['mensaje'] = "No hay cargas registradas";
        }
        echo $this->render->render("view/cargaView.php", $data);
    }
    public function borrarCarga()
    {
        $this->cargasModel->dropCarga($_POST['borrar_id']);
        header("location: editarCarga");
        exit();
    }
    public function actualizarCarga()
    {
        $this->cargasModel->actualizarCarga($_POST);
        header("location: editarCarga");
        exit();
    }

    public function modificarCarga()
    {
        $data['vistaModificacionDeCarga']=true;
        $data['arrastre']=$this->cargasModel->getArrastres();;
        $data['carga']=$this->cargasModel->getUnicaCarga($_POST['modificar_id']);

        echo $this->render->render("view/cargaView.php", $data);
    }
}