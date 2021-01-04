<?php

use Component\App;
use Component\Router;

//Режим разработчика
define('DEV', true);

if(DEV){
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}

//Пути приложения
define('ROOT', dirname(__FILE__));
define('APPS', require_once ROOT.'/config/apps.php');

require_once(ROOT.'/vendor/autoload.php');

if(!isset(APPS['']))die("Приложение по умолчанию не определено.");

//Определение приложения
App::$path = ROOT.'/'.APPS[''];
foreach (APPS as $app_find => $path_find){
    if(file_exists(ROOT.'/'.$path_find)){
        App::$apps[$app_find] = ROOT.'/'.$path_find;
        if(explode('/', $_SERVER["REQUEST_URI"])[1] === $app_find){
            App::$path = ROOT.'/'.$path_find;
        }
    }
}
define('APP', App::$path);

require_once App::$path . '/index.php';

// Вызов Router
$router = new Router();
$router->run();