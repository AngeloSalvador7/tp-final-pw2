<?php
/*HELPERS*/
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");
include_once("helper/SessionCheck.php");
include_once("helper/Correo.php");

/*MODEL*/
include_once("model/HomeModel.php");
include_once("model/DatosModel.php");
include_once("model/ChoferModel.php");
include_once("model/EmpleadosModel.php");
include_once("model/CargasModel.php");
include_once("model/ProformasModel.php");
include_once("model/VehiculosModel.php");
include_once("model/ClienteModel.php");
include_once("model/ViajesModel.php");
include_once("model/ChoferModel.php");
include_once("model/ViajeModel.php");
include_once("model/FacturaModel.php");
include_once("model/ServiceModel.php");

/*CONTROLLER*/
include_once("controller/ChoferController.php");
include_once("controller/EmpleadosController.php");
include_once("controller/ViajesController.php");
include_once("controller/RegisterController.php");
include_once("controller/LoginController.php");
include_once("controller/HomeController.php");
include_once("controller/LogoutController.php");
include_once("controller/SupervisorCargaController.php");
include_once("controller/ProformasController.php");
include_once("controller/SupervisorVehiculosController.php");
include_once("controller/SupervisorClientesController.php");
include_once("controller/ChoferController.php");
include_once("controller/DatosController.php");
include_once("controller/MecanicoController.php");

/*Other*/
include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once('third-party/Globales.php');
include_once("Router.php");

class Configuration
{

    private function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }

    private function getDatabase()
    {
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    /*Model*/
    public function getHomeModel()
    {
        return new HomeModel($this->getDatabase());
    }

    public function getCargasModel()
    {
        $database = $this->getDatabase();
        return new CargasModel($database);
    }

    public function getChoferModel()
    {
        $database = $this->getDatabase();
        return new ChoferModel($database);
    }

    public function getEmpleadosModel()
    {
        $database = $this->getDatabase();
        return new EmpleadosModel($database);
    }

    public function getProformasModel()
    {
        $database = $this->getDatabase();
        return new ProformasModel($database);
    }

    public function getVehiculosModel()
    {
        $database = $this->getDatabase();
        return new VehiculosModel($database);
    }

    public function getClientesModel()
    {
        $database = $this->getDatabase();
        return new ClienteModel($database);
    }

    public function getViajeModel()
    {
        $database = $this->getDatabase();
        return new ViajeModel($database);
    }

    public function getViajesModel()
    {
        $database = $this->getDatabase();
        return new ViajesModel($database);
    }

    public function getFacturaModel()
    {
        $database = $this->getDatabase();
        return new FacturaModel($database);
    }

    public function getDatosModel()
    {
        $database = $this->getDatabase();
        return new DatosModel($database);
    }

    public function getServiceModel()
    {
        $database = $this->getDatabase();
        return new ServiceModel($database);
    }

    /*Controller*/
    public function getEmpleadosController()
    {
        $empleadosModel = $this->getEmpleadosModel();
        return new EmpleadosController($this->getRender(), $empleadosModel);
    }

    public function getHomeController()
    {
        return new HomeController($this->getRender(), $this->getHomeModel());
    }

    public function getDatosController()
    {
        return new DatosController($this->getRender(), $this->getDatosModel());
    }

    public function getProformasController()
    {
        return new ProformasController($this->getRender(), $this->getProformasModel());
    }

    public function getClientesController()
    {
        return new SupervisorClientesController($this->getRender(), $this->getClientesModel());
    }

    public function getLogoutController()
    {
        return new LogoutController($this->getRender());
    }

    public function getRegisterController()
    {
        return new RegisterController($this->getEmpleadosModel(), $this->getRender());
    }

    public function getLoginController()
    {
        return new LoginController($this->getRender(), $this->getEmpleadosModel());
    }

    public function getCargasController()
    {
        return new SupervisorCargaController($this->getRender(), $this->getCargasModel());
    }

    public function getVehiculosController()
    {
        return new SupervisorVehiculosController($this->getRender(), $this->getVehiculosModel());
    }

    public function getViajesController()
    {
        return new ViajesController($this->getRender(), $this->getViajesModel());
    }

    public function getChoferController()
    {
        return new ChoferController($this->getRender(), $this->getChoferModel(), $this->getVehiculosModel(), $this->getViajeModel(), $this->getFacturaModel());
    }
    public function getMecanicoController()
    {
        return new MecanicoController($this->getRender(), $this->getVehiculosModel(), $this->getViajeModel(), $this->getServiceModel());
    }
    public function getRender()
    {
        return new Render('view/partial');
    }

    public function getRouter()
    {
        return new Router($this);
    }

    public function getUrlHelper()
    {
        return new UrlHelper();
    }
}
