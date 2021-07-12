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

    public function contrastarPresupuesto($id){
        $datos = $this->database->query("SELECT * FROM Comparacion WHERE id = $id")[0];

        if(empty($datos))
            return false;

        $diffPeaje = $datos['costo_peaje_estimado'] - $datos['costo_peaje'];
        $diffViaticos = $datos['costo_viaticos_estimado'] - $datos['costo_viaticos'];
        $diffHospedaje = $datos['costo_hospedaje_estimado'] - $datos['costo_hospedaje'];
        $diffExtras = $datos['extra_estimado'] - $datos['extra'];


        $datos['ComparacionPeaje'] = $this->color($diffPeaje);
        $datos['ComparacionViaticos'] = $this->color($diffViaticos);
        $datos['ComparacionHospedaje'] = $this->color($diffHospedaje);
        $datos['ComparacionExtras'] = $this->color($diffExtras);

        $datos['Total'] = $this->color($diffPeaje + $diffViaticos + $diffHospedaje + $diffExtras + $datos['tarifa']);

        $datos['ComparacionKilometros'] = $datos['km_estimado'] - $datos['km_real'];
        $datos['ComparacionCombustible'] = $datos['combustible_estimado'] - $datos['combustible_real'];

        return $datos;
    }

    private function color($valor){
        if($valor > 0){
            return '<span class="text-success">+ U$D '.$valor.'</span>';
        }

        if($valor < 0){
            return '<span class="text-danger">- U$D '. abs($valor).'</span>';
        }

        return $valor;
    }
}
