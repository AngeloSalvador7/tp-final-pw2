<?php 

class SessionCheck{

    private $UrlsExcluidas = [
        "/", "/register", "/register/registerEmployee", "/login/validateEmployee"
    ];


    public function __construct($rol = null) {

        if(!isset($_SESSION['usuario']) && !in_array($_SERVER['REQUEST_URI'], $this->UrlsExcluidas)) {
            header("location: http://localhost/");
            exit();
        }

        if(isset($rol) && isset($_SESSION['usuario']['descripcion']) && $_SESSION['usuario']['descripcion'] != $rol){
            header("location: http://localhost/home");
            exit();
        }

    }


}

?>