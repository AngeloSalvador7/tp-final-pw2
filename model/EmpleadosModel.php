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

    public function getNuevosEmpleados(){
        return $this->database->query("SELECT * FROM empleado e where e.id_rol IS NULL");
    }

    public function getRol(){
        return $this->database->query("SELECT id as rol, descripcion FROM rol r");
    }

    public function asignarRol($datos){
        return $this->database->execute("UPDATE empleado SET id_rol = $datos[rol] where id = $datos[empleado]");
    }

    public function addEmployee($form)
    {
        return $this->database->execute("INSERT INTO empleado(dni,fecha_nacimiento,nombre,apellido,email,clave) VALUES ($form[dni],'$form[fecha_nacimiento]','$form[nombre]','$form[apellido]','$form[email]','$form[clave]')");
    }

    public function loginEmployee($form){
        return $this->database->query("SELECT * FROM empleado e LEFT JOIN rol r ON e.id_rol = r.id where email='$form[email]' and clave='$form[clave]'");
    }
}