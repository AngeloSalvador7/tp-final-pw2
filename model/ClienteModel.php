<?php

class ClienteModel{

    private $database;

    public function __Construct($database)
    {
        $this -> database = $database;
    }


    public function agregarCliente($form){

        $sql="INSERT INTO cliente(denominacion,cuit,direccion,telefono,email,razon_social) VALUES    ('$form[denominacion]',$form[cuit],'$form[direccion]','$form[telefono]','$form[email]','$form[razon_social]')";
            return $this->database->execute($sql);
    }

    public function  getClientes(){
        return $this->database->query("SELECT * FROM cliente");
    }

    public function dropCliente($id)
    {
        return $this->database->execute("delete from cliente where id=$id");
    }

    public function buscarCliente($id){
        return $this->database->query("SELECT id,denominacion,cuit,direccion,telefono,email,razon_social FROM cliente WHERE id=$id");
    }

    public function  modificarCliente($form){
        $sql="UPDATE cliente SET denominacion='$form[denominacion]',cuit=$form[cuit],direccion='$form[direccion]',telefono='$form[telefono]',email='$form[email]',razon_social='$form[razon_social]'  WHERE id=$form[modificar_id]";
        return $this->database->execute($sql);
    }

}