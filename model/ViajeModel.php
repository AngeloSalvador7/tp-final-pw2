<?php


class ViajeModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function iniciarViaje($id)
    {
        return $this->database->execute("UPDATE viaje set estado='En Curso' where id=$id");
    }

    public function actualizarKilometrosRealesDeViaje($idViaje,$kilometrosAActualizar){
        return $this->database->execute("UPDATE viaje set km_real=$kilometrosAActualizar where id=$idViaje");
    }

    public function actualizaPosicionDeViaje($idViaje,$latitud,$longitud){
        return $this->database->execute("UPDATE viaje set latitud=$latitud,longitud=$longitud where id=$idViaje");
    }

    public function consultarViaje($id_viaje){
        return $this->database->query("SELECT * FROM viaje where id = '$id_viaje'")[0];
    }

    public function actualizarCombustibleConsumidoDeViaje($idViaje,$combustibleAActualizar){
        return $this->database->execute("UPDATE viaje set combustible_real=$combustibleAActualizar where id=$idViaje");
    }

}