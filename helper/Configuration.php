<?php
/*HELPERS*/
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");

/*MODEL*/
include_once("model/HomeModel.php");
include_once("model/EmpleadosModel.php");
include_once("model/CargasModel.php");

/*CONTROLLER*/
include_once("controller/EmpleadosController.php");
include_once("controller/RegisterController.php");
include_once("controller/LoginController.php");
include_once("controller/HomeController.php");
include_once("controller/LogoutController.php");
include_once("controller/SupervisorCargaController.php");


/*Other*/
include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");

class Configuration{

    private function getConfig(){
        return parse_ini_file("config/config.ini");
    }

    private function getDatabase(){
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    /*Model*/
    public function getHomeModel(){
            return new HomeModel($this->getDatabase());
    }
    public function getCargasModel(){
        $database = $this->getDatabase();
        return new CargasModel($database);
    }

    public function getEmpleadosModel(){
        $database = $this->getDatabase();
        return new EmpleadosModel($database);
    }

    /*Controller*/
    public function getEmpleadosController(){
        $empleadosModel = $this->getEmpleadosModel();
        return new EmpleadosController($this->getRender(), $empleadosModel);
    }

    public function getHomeController(){
        return new HomeController($this->getRender(),$this->getHomeModel());
    }

    public function getLogoutController(){
        return new LogoutController($this->getRender());
    }

    public function getRegisterController(){
        $usuario=$this->getEmpleadosModel();
        return new RegisterController($usuario,$this->getRender());
    }

    public function getLoginController(){
        return new LoginController($this->getRender(),$this->getEmpleadosModel());
    }

    public function getCargasController(){
        return new SupervisorCargaController($this->getRender(),$this->getCargasModel());
    }
    public function getRender(){
        return new Render('view/partial');
    }

    public function getRouter(){
        return new Router($this);
    }

    public function getUrlHelper(){
        return new UrlHelper();
    }
}