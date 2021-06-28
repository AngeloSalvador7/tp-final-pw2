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
        return $this->database->query("SELECT v.id,v.marca,v.modelo,v.patente,v.motor,v.chasis,v.km_recorrido,t.id as id_tipo,t.descripcion FROM vehiculo v LEFT join tipo_arrastre t ON v.id_tipo = t.id ORDER BY v.id ASC ");
    }

    public function getUnicoVehiculo($id)
    {
        return $this->database->query("SELECT v.id,v.marca,v.modelo,v.patente,v.motor,v.chasis,v.km_recorrido,t.id as id_tipo,t.descripcion FROM vehiculo v LEFT join tipo_arrastre t ON v.id_tipo = t.id where v.id=$id");
    }

    public function getArrastres()
    {
        return $this->database->query("SELECT id as tipo_id, descripcion as tipo_descripcion FROM tipo_arrastre");
    }

    public function actualizarVehiculo($form)
    {
        $tipo = empty($form['id_tipo']) ? 'NULL' : $form['id_tipo'];

        return $this->database->execute($sql = "UPDATE vehiculo
        SET marca='$form[marca]', modelo='$form[modelo]', patente='$form[patente]', motor='$form[motor]',
            chasis='$form[chasis]', km_recorrido=$form[km_recorrido], id_tipo = $tipo
        WHERE id=$form[modificar_id]");
    }

    public function dropVehiculo($id)
    {
        return $this->database->execute("delete from vehiculo where id=$id");
    }

    public function agregarNuevoVehiculo($form)
    {
        $tipo = empty($form['id_tipo']) ? 'NULL' : $form['id_tipo'];
        $SQL = "insert into vehiculo (marca, modelo, patente, motor, chasis, km_recorrido, id_tipo)
        values ('$form[marca]','$form[modelo]','$form[patente]','$form[motor]','$form[chasis]',$form[km_recorrido],$tipo)";

        return $this->database->execute($SQL);
    }
}