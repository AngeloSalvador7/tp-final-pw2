<?php


class ServiceModel
{
    private $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
    }

    public function getServices()
    {
        return $this->database->query("SELECT s.id, s.fecha, s.costo, s.is_externo,s.detalle, e.id as id_mecanico , e.nombre as nombre_mecanico,
                                            v.id as id_vehiculo,v.patente,v.km_recorrido
                                            FROM service s join empleado e on e.id = s.id_mecanico
                                            join vehiculo v on s.id_vechiculo = v.id");
    }
    public function deleteServices($idService)
    {
        return $this->database->query("DELETE FROM service WHERE id=$idService");
    }
    public function addServices($form)
    {
        return $this->database->execute("INSERT INTO service (fecha, costo, is_externo, detalle, id_mecanico, id_vechiculo)
        VALUES  ('$form[fecha]', $form[costo],$form[is_externo],'$form[detalle]',$form[id_mecanico],$form[id_vechiculo])");
    }
}