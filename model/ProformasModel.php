<?php 

class ProformasModel{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getProformas(){
        return $this->database->query("SELECT * FROM ProformaResumen");
    }

    public function getProformaById($id){
        if(!is_numeric($id)) return;

        $proforma = $this->database->query("SELECT * FROM ProformaCompleta WHERE Proforma = $id");

        if(!empty($proforma)){
            $proforma = $proforma[0];

            if(isset($proforma['Hazard'])){
                if($proforma['Hazard'] == 0){
                    $proforma['Hazard'] = 'NO';
                    $proforma['IMOClass'] = 'N/A';
                    $proforma['IMOSClass'] = 'N/A';
                }
                else
                    $proforma['Hazard'] = 'SI';

            }

            if(isset($proforma['Reefer'])){
                if($proforma['Reefer'] == 0){
                    $proforma['Reefer'] = 'NO';
                    $proforma['Temperatura'] = 'N/A';
                }
                else
                    $proforma['Reefer'] = 'SI';

            }
        }
        
        return $proforma;
    }

    public function eliminarProforma($id){
        return $this->database->execute("DELETE FROM presupuesto WHERE id = $id") > 0 
            && $this->database->execute("DELETE FROM viaje WHERE id = $id") > 0;
    }

    public function getTractoresDisponibles($id = null){
        if(is_null($id))
            return $this->database->query("SELECT * FROM Tractores");
        else 
            return $this->database->query("SELECT * FROM Tractores WHERE IdTractor = $id");
    }

    public function getArrastresDisponibles($id = null){
        if(is_null($id))
            return $this->database->query("SELECT * FROM Arrastres");
        else
            return $this->database->query("SELECT * FROM Arrastres WHERE IdArrastre = $id");
    }

    public function getChoferesDisponibles($id = null){
        if(is_null($id))
            return $this->database->query("SELECT * FROM ChoferesDisponibles");
        else
            return $this->database->query("SELECT * FROM ChoferesDisponibles WHERE IdChofer =$id");
    }

    public function getClientes($id = null){
        if(is_null($id))
            return $this->database->query("SELECT id AS IdCliente, concat(razon_social, ' (CUIT: ', cuit, ')')  AS InfoCliente FROM cliente");
        else
            return $this->database->query("SELECT id AS IdCliente, concat(razon_social, ' (CUIT: ', cuit, ')')  AS InfoCliente FROM cliente WHERE id = $id");
    }

    public function getCargasDisponibles($id = null){
        if(is_null($id))
            return $this->database->query("SELECT id FROM carga WHERE id NOT IN(SELECT id_carga FROM viaje WHERE estado <> 'Finalizado')");
        else
            return $this->database->query("SELECT id FROM carga WHERE id NOT IN(SELECT id_carga FROM viaje WHERE estado <> 'Finalizado') AND id = $id");
        
    }

    public function cargarProforma(array $datos){
        if(!$this->validar($datos))
            return false;

        $insViaje = "INSERT INTO viaje (origen, destino, eta, etd, estado, km_estimado, combustible_estimado, id_chofer, id_tractor, id_arrastre, id_carga, id_cliente) 
        VALUES ('$datos[Origen]', '$datos[Destino]', '$datos[ETA]', '$datos[ETD]', '$datos[Estado]', $datos[Kilometros], $datos[Combustible], $datos[Chofer], $datos[Tractor], $datos[Arrastre], $datos[Carga], $datos[Cliente])";

        if($this->database->execute($insViaje) < 1){
            $_SESSION['mensaje'] = "Error al Cargar los datos del Viaje intente nuevamente";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        $insPresupuesto = "INSERT INTO presupuesto (id_viaje, costo_peaje_estimado, costo_viaticos_estimado, costo_hospedaje_estimado, extra_estimado)
        VALUES (".$this->database->idGen()." , $datos[Peaje], $datos[Viaticos], $datos[Hospedaje], $datos[Extras])";

        return $this->database->execute($insPresupuesto) > 0;
    }

    public function actualizarProforma(array $datos){
        if(!$this->validar($datos))
            return false;

        $updViaje = "UPDATE viaje SET origen = '$datos[Origen]', destino = '$datos[Destino]', eta = '$datos[ETA]', etd = '$datos[ETD]', estado = '$datos[Estado]', km_estimado = $datos[Kilometros],
            combustible_estimado = $datos[Combustible], id_chofer = $datos[Chofer], id_tractor = $datos[Tractor], id_arrastre = $datos[Arrastre], id_carga = $datos[Carga], id_cliente = $datos[Cliente] WHERE id = $datos[Proforma]";

        $this->database->execute($updViaje);

        $updPresupuesto = "UPDATE presupuesto SET costo_peaje_estimado = $datos[Peaje], costo_viaticos_estimado = $datos[Viaticos], costo_hospedaje_estimado = $datos[Hospedaje], extra_estimado = $datos[Extras]";
        $this->database->execute($updPresupuesto);

        return true;
    }

    private function validar(array $datos){
        if($datos['Peaje'] < 0 || $datos['Viaticos'] < 0 || $datos['Hospedaje'] < 0 || $datos['Extras'] < 0 ){
            $_SESSION['mensaje'] = "Los valores de los Costos estimados no puede ser negativo!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if($datos['Combustible'] < 0){
            $_SESSION['mensaje'] = "El Consumo de combustible estimado no puede ser negativo!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if($datos['Kilometros'] < 0){
            $_SESSION['mensaje'] = "La distancia en kilometros estimada no puede ser negativa!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if($datos['ETD'] > $datos['ETA']){
            $_SESSION['mensaje'] = "La fecha estimada de partida no puede ser posterior a la fecha estimada de llegada!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if(!in_array($datos['Estado'], ['Finalizado', 'Pendiente', 'En Curso'])){
            $_SESSION['mensaje'] = "Seleccione un estado de viaje valido.";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if(empty($this->getClientes($datos['Cliente']))){
            $_SESSION['mensaje'] = "El Cliente seleccionado no existe.";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        return true;
    }
}
