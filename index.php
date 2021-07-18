<?php
include_once("helper/Configuration.php");
date_default_timezone_set('UTC');

session_start();
$configuration = new Configuration();


$urlHelper = $configuration->getUrlHelper();
$module = $urlHelper->getModuleFromRequestOr("login");
$action = $urlHelper->getActionFromRequestOr("execute");

$router = $configuration->getRouter();
$router->executeActionFromModule($action, $module);