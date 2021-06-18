<?php

class EmpleadosModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getEmpleados(){
        return $this->database->query("SELECT * FROM empleado e join rol r ON e.id_rol = r.id where e.id_rol IS NOT NULL");
    }

    public function getEmpleadoById($id){
        return $this->database->query("SELECT * FROM empleado e join rol r ON e.id_rol = r.id where e.id=$id");
    }

    public function getNuevosEmpleados(){
        return $this->database->query("SELECT * FROM empleado e where e.id_rol IS NULL");
    }

    public function getRol(){
        return $this->database->query("SELECT id as rol, descripcion FROM rol r");
    }

    public function asignarRol($datos){
        return $this->database->execute("UPDATE empleado SET id_rol = $datos[rol] where id = $datos[empleado]");
    }
}