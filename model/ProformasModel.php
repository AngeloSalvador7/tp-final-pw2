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
        return $this->database->execute("DELETE FROM presupuesto WHERE id = $id") > 0;
    }
}
