<?php

class SessionCheck
{

    private $UrlsExcluidas = '/((\/register|\/login).*$)|\/$/m';


    public function __construct($rol = null)
    {

        if (!isset($_SESSION['usuario']) && preg_match($this->UrlsExcluidas, $_SERVER['REQUEST_URI']) == 0) {
            header("location: http://localhost/");
            exit();
        }

        if (isset($rol) && isset($_SESSION['usuario']['descripcion']) && $_SESSION['usuario']['descripcion'] != $rol) {
            header("location: http://localhost/home");
            exit();
        }
    }
}
