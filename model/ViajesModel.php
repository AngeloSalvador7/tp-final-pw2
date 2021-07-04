<?php 

class ViajesModel{

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getViajes($activos)
    {
        if($activos)
            return $this->database->query("SELECT * FROM ViajesResumen WHERE Estado IN ('Pendiente', 'En Curso')");
        else
            return $this->database->query("SELECT * FROM ViajesResumen WHERE Estado IN ('Finalizado', 'Cancelado')");
    }

    public function cancelarViaje($id){
        return $this->database->execute("UPDATE viaje SET estado = 'Cancelado' WHERE id= $id") > 0;
    }
}
