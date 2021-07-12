<?php



class ProformasController extends SessionCheck{

    private $render;
    private $proformaModel;
    private const DatosProforma =
    [
        'Peaje', 'Viaticos', 'Hospedaje', 'Extras', 'Origen', 'Destino', 'ETD', 'ETA', 'Tarifa', 'Kilometros', 'Combustible',
        'Chofer', 'Tractor', 'Arrastre', 'Carga', 'Cliente'
    ];


    public function __construct($render, $proformaModel)
    {
        parent::__construct("SUPERVISOR");
        $this->render = $render;
        $this->proformaModel = $proformaModel;
    }

    public function execute()
    {
        $datos['listaProformas'] = true;
        $datos['proformas'] = $this->proformaModel->getProformas(true);

        if (empty($datos['proformas'])) {
            $datos['mensaje'] = "Actualmente no existe ninguna Proforma";
            $datos['tipoMensaje'] = "warning";
        }

        if (isset($_SESSION['mensaje']) && isset($_SESSION['tipoMensaje'])) {
            $datos['mensaje'] = $_SESSION['mensaje'];
            $datos['tipoMensaje'] = $_SESSION['tipoMensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipoMensaje']);
        }

        echo $this->render->render("view/proformaView.php", $datos);
    }

    public function historico(){
        $datos['listaProformasHistorico'] = true;
        $datos['proformas'] = $this->proformaModel->getProformas(false);

        if (empty($datos['proformas'])) {
            $datos['mensaje'] = "Actualmente no existe ninguna Proforma en el Historico";
            $datos['tipoMensaje'] = "warning";
        }

        echo $this->render->render("view/proformaView.php", $datos);
    }

    public function detalle()
    {
        if (empty($_GET['cod'])) {
            header("location: /proformas");
            exit();
        }

        $datos['test'] = ['dato' => 'nested data'];

        $datos['detalleProforma'] = true;
        $datos['codigoProforma'] = $_GET['cod'];
        $datos['proforma'] = $this->proformaModel->getProformaById($_GET['cod']);

        if (empty($datos['proforma'])) {
            $datos['mensaje'] = "La Proforma solicitada no existe o fue eliminada!";
            $datos['tipoMensaje'] = "danger";
        }

        echo $this->render->render("view/proformaView.php", $datos);
    }

    public function mostrarQr(){
        include('third-party/phpqrcode/qrlib.php');
        if(isset($_GET["id_viaje"])) {
            $id_viaje = $_GET["id_viaje"];
            $url = "http://localhost/chofer/actualizar?id_viaje=" . $id_viaje;

            QRcode::png($url, NULL, 'H', 5, 1);
        }
    }

    public function nueva(){
        $datos['formNuevaProforma'] = true;

        $datos['Tractores'] = $this->proformaModel->getTractoresDisponibles();
        $datos['Arrastres'] = $this->proformaModel->getArrastresDisponibles();
        $datos['Choferes'] = $this->proformaModel->getChoferesDisponibles();
        $datos['Clientes'] = $this->proformaModel->getClientes();
        $datos['Cargas'] = $this->proformaModel->getCargasDisponibles();

        if (isset($_SESSION['mensaje']) && isset($_SESSION['tipoMensaje'])) {
            $datos['mensaje'] = $_SESSION['mensaje'];
            $datos['tipoMensaje'] = $_SESSION['tipoMensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipoMensaje']);
        }

        echo $this->render->render("view/proformaView.php", $datos);
    }

    public function generar()
    {
        foreach (self::DatosProforma as $Llave) {
            if (empty($_POST[$Llave])) {
                $_SESSION['mensaje'] = "Complete el campo $Llave para cargar la proforma!";
                $_SESSION['tipoMensaje'] = "danger";
                header('location: nueva');
                exit();
            }
        }

        if ($this->proformaModel->cargarProforma($_POST)) {
            $_SESSION['mensaje'] = "Proforma cargada con exito!";
            $_SESSION['tipoMensaje'] = "success";
            header('location: /');
            exit();
        }

        header('location: nueva');
        exit();
    }

    public function edicion()
    {
        if (empty($_GET['cod'])) {
            header("location: /proformas");
            exit();
        }

        $datos['formActProforma'] = $this->proformaModel->getProformaById($_GET['cod']);

        if (empty($datos['formActProforma'])) {
            $_SESSION['mensaje'] = "La Proforma solicitada no existe o fue eliminada!";
            $_SESSION['tipoMensaje'] = "danger";
            header("location: /proformas");
            exit();
        }

        $datos['Tractores'] = $this->proformaModel->getTractoresDisponibles();
        $datos['Arrastres'] = $this->proformaModel->getArrastresDisponibles();
        $datos['Choferes'] = $this->proformaModel->getChoferesDisponibles();
        $datos['Clientes'] = $this->proformaModel->getClientes();
        $datos['Cargas'] = $this->proformaModel->getCargasDisponibles();

        if (isset($_SESSION['mensaje']) && isset($_SESSION['tipoMensaje'])) {
            $datos['mensaje'] = $_SESSION['mensaje'];
            $datos['tipoMensaje'] = $_SESSION['tipoMensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipoMensaje']);
        }

        echo $this->render->render("view/proformaView.php", $datos);
    }

    public function modificar()
    {
        if (empty($_POST['Proforma'])) {
            header('location: /');
            exit();
        }

        foreach (self::DatosProforma as $Llave) {
            if (empty($_POST[$Llave])) {
                $_SESSION['mensaje'] = "Complete el campo $Llave para actualizar la proforma!";
                $_SESSION['tipoMensaje'] = "danger";
                header('location: edicion');
                exit();
            }
        }

        if ($this->proformaModel->actualizarProforma($_POST)) {
            $_SESSION['mensaje'] = "Proforma actualizada con exito!";
            $_SESSION['tipoMensaje'] = "success";
            header('location: /');
            exit();
        }

        header('location: edicion');
        exit();
    }

    public function eliminar()
    {
        if (!empty($_POST['proforma']) && $this->proformaModel->eliminarProforma($_POST['proforma'])) {
            $_SESSION['mensaje'] = "Se elimino la proforma $_POST[proforma] correctamente";
            $_SESSION['tipoMensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "No se pudo eliminar la proforma $_POST[proforma]!";
            $_SESSION['tipoMensaje'] = "danger";
        }

        header('location: /');
        exit();
    }

    public function exportarPdf(){
        require('third-party/fpdf/fpdf.php');
        include('third-party/phpqrcode/qrlib.php');
        $datos["id_viaje"]= $_GET["viaje"];
        $datos['detalleProforma'] = true;
        $datos['proforma'] = $this->proformaModel->getProformaById($_GET['viaje']);
        $pdf=$this->proformaModel->exportarProformaPDF($datos);

        echo $this->render->render("view/proformaView.php", $pdf);
    }

}
