<?php

class ProformasController extends SessionCheck
{

    private $render;
    private $proformaModel;


    public function __construct($render, $proformaModel)
    {
        parent::__construct("SUPERVISOR");
        $this->render = $render;
        $this->proformaModel = $proformaModel;
    }

    public function execute()
    {
        $datos['listaProformas'] = true;
        $datos['proformas'] = $this->proformaModel->getProformas();

        if (empty($datos['proformas'])) {
            $datos['mensaje'] = "Actualmente no existe ninguna Proforma";
            $datos['tipoMensaje'] = "warning";
        }

        if(isset($_SESSION['mensaje']) && isset($_SESSION['tipoMensaje'])){
            $datos['mensaje'] = $_SESSION['mensaje'];
            $datos['tipoMensaje'] = $_SESSION['tipoMensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipoMensaje']);
        }

        echo $this->render->render("view/proformaView.php", $datos);
    }

    public function detalle()
    {
        if (empty($_GET['cod'])) {
            header("location: /proformas");
            exit();
        }

        $datos['detalleProforma'] = true;
        $datos['codigoProforma'] = $_GET['cod'];
        $datos['proforma'] = $this->proformaModel->getProformaById($_GET['cod']);

        if (empty($datos['proforma'])) {
            $datos['mensaje'] = "La Proforma solicitada no existe o fue eliminada!";
            $datos['tipoMensaje'] = "danger";
        }

        echo $this->render->render("view/proformaView.php", $datos);
    }

    public function accion()
    {
        if (empty($_POST['proforma']) || empty($_POST['accion'])) {
            header('location: proformas');
            exit();
        }

        if ($_POST['accion'] == 'MODIFICAR')
            $this->editarProforma($_POST['proforma']);

        if ($_POST['accion'] == 'BORRAR')
            $this->eliminarProforma($_POST['proforma']);
    }

    private function editarProforma($id)
    {
        header('location: ');
        exit();
    }

    private function eliminarProforma($id)
    {
        if($this->proformaModel->eliminarProforma($id)){
            $_SESSION['mensaje'] = "Se elimino la proforma #$id correctamente";
            $_SESSION['tipoMensaje'] = "success";
        }else{
            $_SESSION['mensaje'] = "No se pudo eliminar la proforma #$id!";
            $_SESSION['tipoMensaje'] = "danger";
        }

        header('location: /');
        exit();
    }
}
