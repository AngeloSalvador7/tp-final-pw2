<?php

class EmpleadosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getEmpleados()
    {
        return $this->database->query("SELECT e.id, e.dni, e.fecha_nacimiento, e.nombre, e.apellido, e.email, r.id as id_tipo, r.descripcion FROM empleado e join rol r ON e.id_rol = r.id where vigente=1 AND e.id_rol IS NOT NULL");
    }

    public function getEmpleadosSinRol()
    {
        return $this->database->query("SELECT * FROM empleado e where vigente=1 AND e.id_rol IS NULL AND hashcode IS NULL");
    }

    public function getRol()
    {
        return $this->database->query("SELECT id as rol, descripcion FROM rol r");
    }

    public function asignarRol($datos)
    {
        return $this->database->execute("UPDATE empleado SET id_rol = $datos[rol] where vigente=1 AND id = $datos[empleado]");
    }

    public function addEmployee($form)
    {
        $this->database->execute("INSERT INTO empleado(dni,fecha_nacimiento,nombre,apellido,email,clave,vigente) VALUES ($form[dni],'$form[fecha_nacimiento]','$form[nombre]','$form[apellido]','$form[email]','$form[clave]',1)");

        return $this->database->idGen();
    }

    public function setHash($id, $email){
        $md5 = md5($id.$email);

        if($this->database->execute("UPDATE empleado SET hashcode = '$md5' WHERE id=$id") > 0)
            return $md5;
        else
            return null;
    }

    public function validarHash($hash){
        return $this->database->execute("UPDATE empleado SET hashcode = NULL WHERE hashcode = '$hash'") > 0;
    }

    public function loginEmployee($form)
    {
        return $this->database->query("SELECT * FROM empleado e LEFT JOIN rol r ON e.id_rol = r.id where vigente=1 AND email='$form[email]' AND clave='$form[clave]' AND hashcode IS NULL");
    }

    public function eliminarEmpleado($dato)
    {
        return $this->database->execute("UPDATE empleado e SET e.vigente = 0 where e.id = $dato");
    }

    public function getEditarEmpleados($dato)
    {
        return $this->database->query("SELECT * FROM empleado where vigente=1 AND id = $dato");
    }

    public function actualizarEmpleado($form){
        return $this->database->execute("UPDATE empleado SET dni = $form[dni],
                                                            fecha_nacimiento = '$form[fecha_nacimiento]',
                                                            nombre = '$form[nombre]',
                                                            apellido = '$form[apellido]',
                                                            email = '$form[email]',
                                                            id_rol = '$form[rol]',
                                                            clave =  '$form[clave]'
                                                            where vigente=1 AND id=$form[id_empleado]");
    }

    public function getEmpleadosById($id){
        return $this->database->query("SELECT e.id, e.dni, e.fecha_nacimiento, e.nombre, e.apellido, e.email, e.clave, r.id as id_tipo, r.descripcion FROM empleado e join rol r ON e.id_rol = r.id where e.vigente = 1 AND e.id = $id");
    }
}