<?php

class CargasModel
{
    private $database;

    public function __construct(\MysqlDatabase $database)
    {
        $this->database = $database;
    }


    public function getCargas()
    {
        return $this->database->query("SELECT c.id, c.peso_neto,c.hazard,c.imo_class,c.imo_sclass,c.reefer,c.temperatura,t.id as id_tipo,t.descripcion FROM carga c join tipo_arrastre t ON c.id_tipo = t.id ORDER BY c.id ASC ");
    }

    public function getUnicaCarga($id)
    {
        return $this->database->query("SELECT c.id, c.peso_neto,c.hazard,c.imo_class,c.imo_sclass,c.reefer,c.temperatura,t.id as id_tipo,t.descripcion FROM carga c join tipo_arrastre t ON c.id_tipo = t.id where c.id=$id");
    }

    public function getArrastres()
    {
        return $this->database->query("SELECT id as tipo_id, descripcion as tipo_descripcion FROM tipo_arrastre");
    }

    public function actualizarCarga($form)
    {
        return $this->database->execute("UPDATE carga
                                                SET peso_neto = $form[peso_neto],
                                                    hazard=$form[hazard],
                                                    imo_class=$form[clase_IMO],
                                                    imo_sclass=$form[sub_clase_IMO],
                                                    reefer=$form[reefer],
                                                    temperatura=$form[temperatura],
                                                    id_tipo=$form[id_tipo]
                                                WHERE  id=$form[modificar_id]");
    }

    public function dropCarga($id)
    {
        return $this->database->execute("delete from carga where id=$id");
    }

    public function agregarNuevaCarga($form)
    {
        return $this->database->execute("insert into carga (peso_neto, hazard, imo_class, imo_sclass, reefer, temperatura, id_tipo)
        VALUES  ($form[peso_neto],$form[hazard],$form[clase_IMO],$form[sub_clase_IMO],$form[reefer],$form[temperatura],$form[id_tipo])");
    }


}