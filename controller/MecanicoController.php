<?php

class MecanicoController extends SessionCheck
{
    private $render;
    private $vehiculosModel;
    private $viajeModel;
    private $serviceModel;

    public function __construct($getRender, $getVehiculosModel, $getViajeModel, $getServiceModel)
    {
        parent::__construct("MECANICO");
        $this->render = $getRender;
        $this->vehiculosModel = $getVehiculosModel;
        $this->viajeModel = $getViajeModel;
        $this->serviceModel = $getServiceModel;
    }

    public function execute()
    {
        echo $this->render->render("view/homeMecanicoView.php");
    }

    public function service()
    {
        $datos['vistaAccionesService'] = true;
        $datos['service'] = $this->serviceModel->getServices();

        if (!$datos['service'])
            $datos['mensaje'] = "No se encontraron services";
        echo $this->render->render("view/homeMecanicoView.php", $datos);
    }

    public function modificarService()
    {
        $datos['vistaModificarService'] = true;
        echo $this->render->render("view/homeMecanicoView.php", $datos);
    }

    public function agregarService()
    {
        $datos['vistaAgregarService'] = true;
        $datos['vehiculos'] = $this->vehiculosModel->getVehiculos();
        echo $this->render->render("view/homeMecanicoView.php", $datos);
    }

    //uso para los forms, acciones a la BD
    public function insertarService()
    {
        $_POST['id_mecanico'] = $_SESSION['usuario']['id'];

        $this->serviceModel->addServices($_POST);
        header('location: /mecanico/service');
        exit();
    }

    public function borrarService()
    {
        $this->serviceModel->deleteServices($_POST['borrar_id']);
        header('location: /mecanico/service');
        exit();
    }

    public function cambiarService()
    {

    }
}