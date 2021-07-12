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

    public function exportarProformaPDF($data){
        $pdf = new FPDF();

        $pdf->AddPage();
        // Logo
        $pdf->Image('public/images/bandmember.png',80,2,50);
        $pdf->Ln(50);
        // Titulo
        $pdf->SetFont('Helvetica','B',18);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Presupuesto: ".$data["proforma"]["Proforma"],0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->SetTextColor(0,0,0);
        //Costos
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Presupuesto",0,1,'L');
        $pdf->SetFont('Helvetica','',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,10,'Viaticos: $'.$data["proforma"]["Viaticos"],0,1,'L');
        $pdf->Cell(0,10,'Extras: $'.$data["proforma"]["Extras"],0,1,'L');
        $pdf->Cell(0,10,'Hospedaje: $'.$data["proforma"]["Hospedaje"],0,1,'L');
        $pdf->Cell(0,10,'Tarifa: $'.$data["proforma"]["Tarifa"],0,1,'L');
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(33,150,243);
        $total=$data["proforma"]["Viaticos"]+$data["proforma"]["Extras"]+$data["proforma"]["Hospedaje"]+$data["proforma"]["Tarifa"];
        $pdf->Cell(0,10,"TOTAL: $".$total,0,1,'L');
        $pdf->Ln(5);
        //Viaje
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Viaje",0,1,'L');
        $pdf->SetFont('Helvetica','',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,10,'Origen: '.$data["proforma"]["Origen"],0,1,'L');
        $pdf->Cell(0,10,'Destino: '.$data["proforma"]["Destino"],0,1,'L');
        $pdf->Cell(0,10,'ETD: '.$data["proforma"]["ETD"],0,1,'L');
        $pdf->Cell(0,10,'ETA: '.$data["proforma"]["ETA"],0,1,'L');
        $pdf->Cell(0,10,'Kilometros Estimados: '.$data["proforma"]["Kilometros"]." KM",0,1,'L');
        $pdf->Cell(0,10,'Combustible Estimado: '.$data["proforma"]["Combustible"]." L",0,1,'L');
        $pdf->Ln(5);
        // Cliente
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Datos del Cliente",0,1,'L');
        $pdf->SetFont('Helvetica','',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,10,'Denominacion: '.$data["proforma"]["Denominacion"],0,1,'L');
        $pdf->Cell(0,10,'Razon Social: '.$data["proforma"]["RazonSocial"],0,1,'L');
        $pdf->Cell(0,10,'CUIT: '.$data["proforma"]["CUIT"],0,1,'L');
        $pdf->Cell(0,10,'Direccion: '.$data["proforma"]["Direccion"],0,1,'L');
        $pdf->Cell(0,10,'Telefono: '.$data["proforma"]["Telefono"],0,1,'L');
        $pdf->Cell(0,10,'Email: '.$data["proforma"]["EmailCliente"],0,1,'L');
        $pdf->Ln(5);
        // Chofer
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Chofer Asignado",0,1,'L');
        $pdf->SetFont('Helvetica','',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,10,'Apellido y Nombre: '.$data["proforma"]["Chofer"].".",0,1,'L');
        $pdf->Cell(0,10,'DNI: '.$data["proforma"]["DNI"].".",0,1,'L');
        $pdf->Cell(0,10,'Email: '.$data["proforma"]["EmailChofer"].".",0,1,'L');
        $pdf->Cell(0,10,'Numero de licencia: '.$data["proforma"]["NumeroLicencia"].".",0,1,'L');
        $pdf->Ln(5);
        // Vehiculo
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Vehiculos",0,1,'L');
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(0,10,"Tractor",0,1,'L');
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,10,'Marca: '.$data["proforma"]["TMarca"].".",0,1,'L');
        $pdf->Cell(0,10,'Patente: '.$data["proforma"]["TPatente"].".",0,1,'L');
        $pdf->Cell(0,10,'Modelo: '.$data["proforma"]["TModelo"].".",0,1,'L');
        $pdf->SetFont('Helvetica','',12);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Arrastre",0,1,'L');
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,10,'Marca: '.$data["proforma"]["AMarca"].".",0,1,'L');
        $pdf->Cell(0,10,'Patente: '.$data["proforma"]["APatente"].".",0,1,'L');
        $pdf->Cell(0,10,'Modelo: '.$data["proforma"]["AModelo"].".",0,1,'L');
        $pdf->Ln(5);
        //Carga
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(33,150,243);
        $pdf->Cell(0,10,"Carga",0,1,'L');
        $pdf->SetFont('Helvetica','',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,10,'Descripcion: '.$data["proforma"]["DescripcionCarga"],0,1,'L');
        $pdf->Cell(0,10,'Peso Neto: '.$data["proforma"]["Peso"],0,1,'L');
        $pdf->Cell(0,10,'Hazard: '.$data["proforma"]["Hazard"],0,1,'L');
        $pdf->Cell(0,10,'Reefer: '.$data["proforma"]["Reefer"],0,1,'L');
        $pdf->Cell(0,10,'IMO Class: '.$data["proforma"]["IMOClass"],0,1,'L');
        $pdf->Cell(0,10,'IMO Sub-Class: '.$data["proforma"]["IMOSClass"],0,1,'L');
        $pdf->Cell(0,10,'Temperatura: '.$data["proforma"]["Temperatura"],0,1,'L');
        $pdf->Cell(0,10,'Tipo de Carga: '.$data["proforma"]["TipoCarga"],0,1,'L');
        $pdf->Ln(5);

        QRcode::png("http://localhost/chofer/actualizar?id_viaje=" .$data["id_viaje"],"qr_img.png");
        $pdf->Image("qr_img.png", 150,100,40, 40, "png");
        $pdf->Output();
        return $pdf;
    }
}
