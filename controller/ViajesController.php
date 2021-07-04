<?php

class ViajesController extends SessionCheck
{
    private $render;
    private $viajesModel;

    public function __construct($render, $viajesModel)
    {
        parent::__construct("SUPERVISOR");
        $this->render = $render;
        $this->viajesModel = $viajesModel;
    }

    public function execute()
    {
        $datos['listaViajesActivos'] = true;
        $datos['viajes'] = $this->viajesModel->getViajes(true);

        if (empty($datos['viajes'])) {
            $datos['mensaje'] = "Actualmente no existe ningun Viaje activo";
            $datos['tipoMensaje'] = "warning";
        }

        if (isset($_SESSION['mensaje']) && isset($_SESSION['tipoMensaje'])) {
            $datos['mensaje'] = $_SESSION['mensaje'];
            $datos['tipoMensaje'] = $_SESSION['tipoMensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipoMensaje']);
        }

        echo $this->render->render("view/viajesView.php", $datos);
    }

    public function comparacion(){
        if(!isset($_GET['cod'])){
            header("location: viajes");
            exit();
        }

        $datos['comparacion'] = $this->viajesModel->contrastarPresupuesto($_GET['cod']);

        echo $this->render->render("view/viajesView.php", $datos);
    }

    public function historico(){
        $datos['listaViajesHistorico'] = true;
        $datos['viajes'] = $this->viajesModel->getViajes(false);

        if (empty($datos['viajes'])) {
            $datos['mensaje'] = "Actualmente no existe ningun registro en el Historico de Viajes";
            $datos['tipoMensaje'] = "warning";
        }

        echo $this->render->render("view/viajesView.php", $datos);
    }

    public function cancelar(){
        if (empty($_POST['Viaje']) || $this->viajesModel->cancelarViaje($_POST['Viaje']) < 1) {
            $datos['mensaje'] = "No fue posible Cancelar el viaje #$_POST[Viaje].";
            $datos['tipoMensaje'] = "danger";
        }else{
            $datos['mensaje'] = "Viaje #$_POST[Viaje] Cancelado con exito!";
            $datos['tipoMensaje'] = "success";
        }

        header("location: viajes");
        exit();
    }
}