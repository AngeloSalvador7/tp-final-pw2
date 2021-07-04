<?php


class FacturaModel
{

    private $database;

    public function __construct(\MysqlDatabase $database)
    {
        $this->database = $database;
    }

public function consultarFactura($idViaje){
     return    $this->database->query("SELECT * FROM factura where id_viaje=$idViaje");
}
 public function agregarCostosAFactura($idViaje,$costoPeaje,$costoViatico,$costoHospedaje,$costoCombustible){
        $this->database->execute("UPDATE factura SET costo_peaje=$costoPeaje,costo_viaticos=$costoViatico,costo_hospedaje=$costoHospedaje, extra=$costoCombustible where id_viaje=$idViaje");
 }

}