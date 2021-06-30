<?php

class ClienteModel{

    private $database;

    public function __Construct($database)
    {
        $this -> database = $database;
    }


    public function agregarCliente($form){

        $sql="INSERT INTO cliente(denominacion,cuit,direccion,telefono,email,razon_social,vigente) 
        VALUES ('$form[denominacion]',$form[cuit],'$form[direccion]','$form[telefono]','$form[email]','$form[razon_social]', 1)";

        return $this->database->execute($sql);
    }

    public function  getClientes(){
        return $this->database->query("SELECT * FROM cliente WHERE vigente = 1");
    }

    public function dropCliente($id)
    {
        return $this->database->execute("UPDATE cliente SET vigente = 0 WHERE id=$id");
    }

    public function buscarCliente($id){
        return $this->database->query("SELECT * FROM cliente WHERE vigente = 1 AND id=$id");
    }

    public function  modificarCliente($form){
        $sql="UPDATE cliente SET denominacion='$form[denominacion]',cuit=$form[cuit],direccion='$form[direccion]',telefono='$form[telefono]',email='$form[email]',razon_social='$form[razon_social]'  
            WHERE id=$form[modificar_id] AND vigente = 1";
        return $this->database->execute($sql);
    }

}