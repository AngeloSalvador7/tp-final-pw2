<?php

class DatosController extends SessionCheck
{
    private $render;
    private $datosModel;

    public function __construct($render, $datosModel)
    {
        parent::__construct("SUPERVISOR");
        $this->render = $render;
        $this->datosModel = $datosModel;
    }

    public function execute()
    {
        echo $this->render->render("view/graficosViajesView.php");
    }

    public function vehiculos()
    {
        if (!empty($_GET['vehiculo']))
            $datos['seleccionado'] = $this->datosModel->getVehiculoById(intval($_GET['vehiculo']));

        $datos['vehiculos'] = $this->datosModel->getVehiculos();
        echo $this->render->render("view/graficosVehiculosView.php", $datos);
    }

    public function getViajes()
    {
        echo json_encode($this->datosModel->numeroViajesPorEstado());
    }

    public function getGanancias()
    {
        $year = empty($_GET['year']) ? date("Y") : $_GET['year'];

        echo json_encode($this->datosModel->promedioGanancias($year));
    }

    public function vehiculoRendKm()
    {
        $vehiculo = empty($_GET['vehiculo']) ? 0 : intval($_GET['vehiculo']);
        echo json_encode($this->datosModel->rendVehiculoKm($vehiculo));
    }

}
