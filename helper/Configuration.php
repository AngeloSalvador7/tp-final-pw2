<?php
/*HELPERS*/
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");
/*MODEL*/
include_once("model/EmployeeModel.php");
include_once("model/HomeModel.php");

include_once("model/EmpleadosModel.php");
include_once("model/TourModel.php");
include_once("model/SongModel.php");

/*CONTROLLER*/
include_once("controller/EmpleadosController.php");
include_once("controller/RegisterController.php");
include_once("controller/LoginController.php");
include_once("controller/HomeController.php");
include_once("controller/LogoutController.php");


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
    public function  getEmployeeModel(){
        return new employeeModel($this->getDatabase());
    }

    public function getHomeModel(){
            return new HomeModel($this->getDatabase());
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
        $usuario=$this->getEmployeeModel();
        return new RegisterController($usuario,$this->getRender());
    }

    public function getLoginController(){
        return new LoginController($this->getRender(),$this->getEmployeeModel());
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