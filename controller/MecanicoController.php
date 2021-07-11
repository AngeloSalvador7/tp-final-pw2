<?php


class MecanicoController
{
    private $render;
    private $mecanicoModel;
    private $vehiculosModel;
    private $viajeModel;
    private $facturaModel;

    public function __construct(Render $getRender, MecanicoModel $getMecanicoModel, VehiculosModel $getVehiculosModel, ViajeModel $getViajeModel, ServiceModel $getServiceModel)
    {
        parent::__construct("MECANICO");
        $this->render = $getRender;
        $this->mecanicoModel = $getMecanicoModel;
        $this->vehiculosModel = $getVehiculosModel;
        $this->viajeModel = $getViajeModel;
        $this->facturaModel = $getServiceModel;
    }

    public function execute()
    {
        echo $this->render->render("view/homeMecanicoView.php");
    }



}