<?php
class SupervisorVehiculosController extends SessionCheck
{
    private $render;
    private $vehiculosModel;

    public function __construct($render, $vehiculosModel)
    {
        parent::__construct("SUPERVISOR");
        $this->render = $render;
        $this->vehiculosModel = $vehiculosModel;
    }

    public function execute()
    {
        $this->VehiculosView();
    }

    private function VehiculosView()
    {
        if(!$_SESSION['usuario']){
            header("Location: /");
            exit();
        }

        $data['usuario']=$_SESSION['usuario'];
        $data['vistaVehiculos']=true;
        $data['vehiculos']=$this->vehiculosModel->getVehiculos();

        if (!$data['vehiculos']){
            $data['mensaje'] = "No hay vehiculos registrados";
        }

        echo $this->render->render("view/vehiculoView.php", $data);
    }

    public function agregarVehiculo()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaAgregarVehiculo']=true;
        $data['arrastre']=$this->vehiculosModel->getArrastres();
        $data['vehiculo']=$this->vehiculosModel->getVehiculos();

        echo $this->render->render("view/vehiculoView.php", $data);
    }

    public function insertarVehiculo()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaVehiculos']=true;
        $this->vehiculosModel->agregarNuevoVehiculo($_POST);
        header('location: http://localhost/vehiculos');
        exit();
    }

    public function editarVehiculo()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaModificarVehiculo']=true;
        $data['vehiculos']=$this->vehiculosModel->getVehiculos();
        $data['arrastre']=$this->vehiculosModel->getArrastres();;
        if (!$data['vehiculos']){
            $data['mensaje'] = "No hay vehiculos registrados";
        }
        echo $this->render->render("view/vehiculoView.php", $data);
    }

    public function borrarVehiculo()
    {
        $this->vehiculosModel->dropVehiculo($_POST['borrar_id']);
        header('location: editarVehiculo');
        exit();
    }

    public function actualizarVehiculo()
    {
        $this->vehiculosModel->actualizarVehiculo($_POST);
        header('location: editarVehiculo');
        exit();
    }

    public function modificarVehiculo()
    {
        $data['vistaModificacionDeVehiculo']=true;
        $data['arrastre']=$this->vehiculosModel->getArrastres();
        $data['vehiculo']=$this->vehiculosModel->getUnicoVehiculo($_POST['modificar_id']);

        echo $this->render->render("view/vehiculoView.php", $data);
    }
}