<?php


class employeeModel
{
    private $database;


    public function __construct($database)
    {
        $this->database = $database;
    }

    public function addEmployee($form)
    {
        return $this->database->execute("INSERT INTO empleado(dni,fecha_nacimiento,nombre,apellido,email,clave) VALUES ($form[dni],'$form[fecha_nacimiento]','$form[nombre]','$form[apellido]','$form[email]','$form[clave]')");
    }

    public function loginEmployee($form){
        return $this->database->query("SELECT * FROM empleado where email='$form[email]' and clave='$form[clave]'");
    }
}