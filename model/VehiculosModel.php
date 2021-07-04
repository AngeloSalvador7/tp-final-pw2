<?php

class VehiculosModel
{
    private $database;

    public function __construct(\MysqlDatabase $database)
    {
        $this->database = $database;
    }

    public function getVehiculos()
    {
        return $this->database->query("SELECT v.id,v.marca,v.modelo,v.patente,v.motor,v.chasis,v.km_recorrido,t.id AS id_tipo,t.descripcion FROM vehiculo v LEFT JOIN tipo_arrastre t ON v.id_tipo = t.id WHERE v.vigente = 1");
    }

    public function getUnicoVehiculo($id)
    {
        return $this->database->query("SELECT v.id,v.marca,v.modelo,v.patente,v.motor,v.chasis,v.km_recorrido,t.id AS id_tipo,t.descripcion FROM vehiculo v LEFT JOIN tipo_arrastre t ON v.id_tipo = t.id WHERE v.vigente = 1 AND v.id=$id");
    }

    public function getArrastres()
    {
        return $this->database->query("SELECT id AS tipo_id, descripcion AS tipo_descripcion FROM tipo_arrastre");
    }

    public function actualizarVehiculo($form)
    {
        $tipo = empty($form['id_tipo']) ? 'NULL' : $form['id_tipo'];

        return $this->database->execute("UPDATE vehiculo
        SET marca='$form[marca]', modelo='$form[modelo]', patente='$form[patente]', motor='$form[motor]',
            chasis='$form[chasis]', km_recorrido=$form[km_recorrido], id_tipo = $tipo
        WHERE vigente = 1 AND id=$form[modificar_id]");
    }

    public function dropVehiculo($id)
    {
        return $this->database->execute("UPDATE vehiculo SET vigente = 0 WHERE id=$id");
    }

    public function agregarNuevoVehiculo($form)
    {
        $tipo = empty($form['id_tipo']) ? 'NULL' : $form['id_tipo'];
        $SQL = "INSERT INTO vehiculo (marca, modelo, patente, motor, chasis, km_recorrido, id_tipo, vigente)
        VALUES ('$form[marca]','$form[modelo]','$form[patente]','$form[motor]','$form[chasis]',$form[km_recorrido],$tipo, 1)";

        return $this->database->execute($SQL);
    }

    public function actualizarKilometraje($vehiculoId,$kilometrajeAActualizar){
         return $this->database->execute("UPDATE vehiculo set km_recorrido=$kilometrajeAActualizar where id=$vehiculoId");
    }

}