<?php
class ChoferModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function tieneLicencia($id)
    {
        return $this->database->query("SELECT c.numero_licencia FROM chofer c join empleado e on c.id_empleado = e.id where c.id_empleado = $id");
    }

    public function agregarLicencia($form)
    {
        return $this->database->execute("INSERT INTO chofer (id_empleado, numero_licencia) VALUES ($form[id_chofer], $form[licencia])");
    }

    public function editarLicencia($form)
    {
        return $this->database->execute("UPDATE chofer SET numero_licencia = $form[licencia] where id_empleado=$form[id_chofer]");
    }

    public function getChoferById($id)
    {
        return $this->database->query("SELECT c.numero_licencia, c.id_empleado as id_chofer FROM chofer c join empleado e on c.id_empleado = e.id where c.id_empleado = $id");
    }
}