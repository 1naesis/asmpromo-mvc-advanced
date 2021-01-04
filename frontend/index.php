<?php
//Developer mode true/false
define('DEV', true);

//Root directory
define('ROOT', dirname(__FILE__));

if(DEV){
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}

// Подключение файлов системы
require_once(ROOT.'/vendor/autoload.php');

// Вызов Router
$router = new Component\Router();
$router->run();