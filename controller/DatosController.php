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

    public function getViajes()
    {
        echo json_encode($this->datosModel->numeroViajesPorEstado());
    }

    public function getGanancias()
    {
        $year = empty($_GET['year']) ? date("Y") : $_GET['year'];

        echo json_encode($this->datosModel->promedioGanancias($year));
    }
}
