<?php


class SupervisorClientesController extends SessionCheck
{

    private $render;
    private $clienteModel;

    public function __construct($render,$clienteModel)
    {
        parent::__construct("SUPERVISOR");
        $this->render = $render;
        $this->clienteModel=$clienteModel;
    }

    public function execute()
    {
        $data['vistaCliente']=true;
        $data['clientes']=$this->clienteModel->getClientes();

        if (!$data['clientes']){
            $data['mensaje'] = "No hay Clientes Registrados ";
        }

        echo $this->render->render("view/clienteView.php", $data);

    }



    public function borrarCliente()
    {
        $this->clienteModel->dropCliente($_POST['borrar_id']);
        header('location: editarCliente');
        exit();
    }

    public function agregarCliente()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaAgregarCliente']=true;
        $data['cliente']=$this->clienteModel->getClientes();
        echo $this->render->render("view/clienteView.php", $data);
    }

    public function insertarCliente()
    {
        $data['vistaCliente']=true;
        $this->clienteModel->agregarCliente($_POST);
        header('location: http://localhost/clientes');
        exit();
    }

    public function editarCliente()
    {
        $data['usuario']=$_SESSION['usuario'];
        $data['vistaModificarCliente']=true;
        $data['clientes']=$this->clienteModel->getClientes();
        if (!$data['clientes']){
            $data['mensaje'] = "No hay clientes registrados";
        }
        echo $this->render->render("view/clienteView.php", $data);
    }


    public function modificarCliente()
    {
        $data['vistaModificacionDeCliente']=true;
        $data['cliente']=$this->clienteModel->buscarCliente($_POST['modificar_id']);
        echo $this->render->render("view/clienteView.php", $data);
    }

    public function actualizarCliente()
    {
        $this->clienteModel->modificarCliente($_POST);
        header('location: editarCliente');
        exit();
    }
}