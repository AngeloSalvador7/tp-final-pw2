<?php


class employeeModel
{
    private $database;


    public function __construct($database)
    {
        $this->database = $database;
    }

    public function addEmployee($dni, $fecha_nacimiento, $nombre, $apellido, $email, $clave)
    {
        return $this->database->execute("INSERT INTO empleado(dni,fecha_nacimiento,nombre,apellido,email,clave) VALUES ($dni,'$fecha_nacimiento','$nombre','$apellido','$email','$clave')");

    }
}