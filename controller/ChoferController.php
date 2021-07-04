<?php


class ChoferController extends SessionCheck
{
    private $render;
    private $choferModel;
    private $vehiculosModel;
    private $viajeModel;
    private $facturaModel;

    public function __construct($render, $choferModel,$vehiculosModel,$viajeModel,$facturaModel){
        parent::__construct("CHOFER");
        $this->render = $render;
        $this-> choferModel = $choferModel;
        $this->vehiculosModel = $vehiculosModel;
        $this->viajeModel=$viajeModel;
        $this->facturaModel=$facturaModel;
    }

    public function execute(){
        if(isset($_SESSION['msg'])) {
            $datos['mensaje'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if(empty($this->choferModel->tieneLicencia($_SESSION['usuario']['id']))){
            $datos['completarLicencia'] = $_SESSION['usuario']['id'];
        }else {
            $datos['editarLicencia'] = $this->choferModel->getChoferById($_SESSION['usuario']['id']);
        }

        echo $this->render->render("view/homeChoferView.php", $datos);
    }

    public function agregarLicencia(){
        $_SESSION['msg'] = "Se guardó la licencia";
        $this->choferModel->agregarLicencia($_POST);

        header('location:/chofer');
        exit();
    }

    public function editarLicencia(){
        if($this->choferModel->editarLicencia($_POST) > 0){
            $_SESSION['msg'] = "Se actualizó la licencia";
        }

        header('location:/chofer');
        exit();

    }

    public function actualizarDatosRealesDelViaje(){
        //traer viaje
        $viaje=$this->viajeModel->consultarViaje($_POST['id_viaje']);
        if($viaje==null){
            header('location: /empleados');
            exit();
        }

        $factura=$this->facturaModel->consultarFactura($viaje['id']);
        //metodo que inserte mediante query los km a vehiculo(sumar km a km_recorrido)
        $vehiculo=$this->vehiculosModel->getUnicoVehiculo($viaje['id_tractor']);
        $this->vehiculosModel->actualizarKilometraje($vehiculo['id'],   $this->incrementoDeValores($vehiculo['km_recorrido'],$_POST['kilometros']));

        //metodo que inserte mediante query los km/latitud-longitud a viaje(sumar km a km_real y updatear lon-latitud a los actuales.)

        $this->viajeModel->actualizarKilometrosRealesDeViaje($viaje['id'],$this->incrementoDeValores($vehiculo['km_recorrido'],$_POST['kilometros']));
        $this->viajeModel->actualizarPosicionDeViaje($viaje['id'],$_POST['latitud'],$_POST['longitud']);

         //metodo que inserte mediante query el combustible cargado a viaje(sumar combustible a combustible_real)

        $this->viajeModel->actualizarCombustibleConsumidoDeViaje($viaje['id'],$this->incrementoDeValores($viaje['combustible_real'],$_POST['combustible_cargado']));

        //metodo que inserte mediante query el costo peaje/costo viatico/costo hospedaje/costo combustible en la factura ( sumar valores a los datos de db)
        $costoPeaje=$this->incrementoDeValores($factura['costo_peaje'],$_POST['costo-peaje']);
        $costoViatico=$this->incrementoDeValores($factura['costo_viaticos'],$_POST['costo-viatico']);
        $costoHospedaje=$this->incrementoDeValores($factura['costo_hospedaje'],$_POST['costo-hospedaje']);
        $costoCombustible=$this->incrementoDeValores($factura['costo_combustible'],$_POST['costo-combustible']);
        $this->facturaModel->agregarCostosAFactura($viaje['id'],$costoPeaje,$costoViatico,$costoHospedaje,$costoCombustible);

        header('location: /empleados');
        exit();
    }

    public function actualizar(){

        if(isset($_GET['id_viaje'])){
            header('location : /chofer');
        }
        /*$viajeObtenido=$this->viajeModel->consultarViaje($_GET['id_viaje']);
  if($viajeObtenido==null || $viajeObtenido['id_chofer']==$_SESSION['usuario']  ['id']     ){
         header('location: /chofer');
         exit();
     }*/
      $datos['vistaActualizarDatosViaje']=true;
        $datos['id_viaje']=$_GET['id_viaje'];
        echo $this->render->render("view/homeChoferView.php", $datos);
    }

    public function incrementoDeValores($valorActual,$valorASumar){
        if($valorActual==null){
            $valorActual=0;
        }
        if($valorASumar==null){
            $valorASumar=0;
        }
        return ($valorActual + $valorASumar);
    }

}