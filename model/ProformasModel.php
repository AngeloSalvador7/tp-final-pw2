<?php

class ProformasModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getProformas($activo)
    {
        if($activo)
            return $this->database->query("SELECT * FROM ProformaResumen WHERE Estado IN ('Pendiente', 'En Curso')");
        else
            return $this->database->query("SELECT * FROM ProformaResumen WHERE Estado IN ('Finalizado', 'Cancelado')");
    }

    public function getProformaById($id)
    {
        if (!is_numeric($id)) return;

        $proforma = $this->database->query("SELECT * FROM ProformaCompleta WHERE Proforma = $id");

        if (!empty($proforma)) {
            $proforma = $proforma[0];

            if (isset($proforma['Hazard'])) {
                if ($proforma['Hazard'] == 0) {
                    $proforma['Hazard'] = 'NO';
                    $proforma['IMOClass'] = 'N/A';
                    $proforma['IMOSClass'] = 'N/A';
                } else
                    $proforma['Hazard'] = 'SI';
            }

            if (isset($proforma['Reefer'])) {
                if ($proforma['Reefer'] == 0) {
                    $proforma['Reefer'] = 'NO';
                    $proforma['Temperatura'] = 'N/A';
                } else
                    $proforma['Reefer'] = 'SI';
            }
        }

        return $proforma;
    }

    public function eliminarProforma($id)
    {
        return $this->database->execute("DELETE FROM presupuesto WHERE id = $id") > 0 
            && $this->database->execute("DELETE FROM factura WHERE id = $id") > 0
            && $this->database->execute("DELETE FROM viaje WHERE id = $id") > 0;
    }

    public function getTractoresDisponibles()
    {
        return $this->database->query("SELECT * FROM Tractores");
    }

    public function getArrastresDisponibles()
    {
        return $this->database->query("SELECT * FROM Arrastres");
    }

    public function getChoferesDisponibles()
    {
        return $this->database->query("SELECT * FROM ChoferesDisponibles");
    }

    public function getClientes()
    {
        return $this->database->query("SELECT id AS IdCliente, concat(razon_social, ' (CUIT: ', cuit, ')')  AS InfoCliente FROM cliente WHERE vigente = 1");
    }

    public function getCargasDisponibles()
    {
        return $this->database->query("SELECT * FROM CargasDisponibles");
    }

    public function cargarProforma(array $datos)
    {
        if (!$this->validar($datos))
            return false;

        $insViaje = "INSERT INTO viaje (origen, destino, eta, etd, estado, id_chofer, id_tractor, id_arrastre, id_carga, id_cliente) 
        VALUES ('$datos[Origen]', '$datos[Destino]', '$datos[ETA]', '$datos[ETD]', 'Pendiente', $datos[Chofer], $datos[Tractor], $datos[Arrastre], $datos[Carga], $datos[Cliente])";

        if ($this->database->execute($insViaje) < 1) {
            $_SESSION['mensaje'] = "Error al Cargar los datos del Viaje intente nuevamente";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        $id = $this->database->idGen();

        $this->database->execute("INSERT INTO factura (id_viaje) VALUES ($id)");

        $insPresupuesto = "INSERT INTO presupuesto (id_viaje, costo_peaje_estimado, costo_viaticos_estimado, costo_hospedaje_estimado, extra_estimado, km_estimado, combustible_estimado, tarifa)
        VALUES ($id, $datos[Peaje], $datos[Viaticos], $datos[Hospedaje], $datos[Extras], $datos[Kilometros], $datos[Combustible], $datos[Tarifa])";

        return $this->database->execute($insPresupuesto) > 0;
    }

    public function actualizarProforma(array $datos)
    {
        if (!$this->validar($datos))
            return false;

        $updProforma = 
        "UPDATE viaje v JOIN presupuesto p ON v.id = p.id_viaje 
        SET v.origen = '$datos[Origen]', v.destino = '$datos[Destino]', v.eta = '$datos[ETA]', v.etd = '$datos[ETD]', v.id_chofer = $datos[Chofer],
            v.id_tractor = $datos[Tractor], v.id_arrastre = $datos[Arrastre], v.id_carga = $datos[Carga], v.id_cliente = $datos[Cliente], p.costo_peaje_estimado = $datos[Peaje],
            p.costo_viaticos_estimado = $datos[Viaticos], p.costo_hospedaje_estimado = $datos[Hospedaje], p.extra_estimado = $datos[Extras] , p.km_estimado = $datos[Kilometros],
            p.combustible_estimado = $datos[Combustible], p.tarifa = $datos[Tarifa] 
        WHERE v.id = $datos[Proforma]";

        return $this->database->execute($updProforma) > 0;
    }

    private function validar(array $datos)
    {
        if ($datos['Peaje'] < 0 || $datos['Viaticos'] < 0 || $datos['Hospedaje'] < 0 || $datos['Extras'] < 0) {
            $_SESSION['mensaje'] = "Los valores de los Costos estimados no puede ser negativo!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if ($datos['Combustible'] < 0) {
            $_SESSION['mensaje'] = "El Consumo de combustible estimado no puede ser negativo!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if ($datos['Kilometros'] < 0) {
            $_SESSION['mensaje'] = "La distancia en kilometros estimada no puede ser negativa!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        if ($datos['ETD'] > $datos['ETA']) {
            $_SESSION['mensaje'] = "La fecha estimada de partida no puede ser posterior a la fecha estimada de llegada!";
            $_SESSION['tipoMensaje'] = "danger";
            return false;
        }

        return true;
    }
}
