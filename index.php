<?php

use Component\App;
use Component\Db;
use Component\Router;

//Режим разработчика
define('DEV', true);

if(DEV){
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}

//Пути приложения
define('ROOT', dirname(__FILE__));
if(!file_exists(ROOT . '/config/apps.php')){
    throw new Exception("Ошибка: Отсутствует файл apps.php, по пути '". ROOT . "/config/'");
}
define('APPS', require_once ROOT . '/config/apps.php');
if(!file_exists(ROOT.'/config/config.php')) {
    throw new Exception("Ошибка: Отсутствует файл config.php, по пути '". ROOT . "/config/'");
}
$config = require_once ROOT.'/config/config.php';

require_once(ROOT.'/vendor/autoload.php');

if(!isset(APPS['']))throw new Exception("Приложение по умолчанию не определено.");

if(isset($config['db'])){
    App::$db = new $config['db']['dbtype'];
    App::$db::setup( 'mysql:host='.$config['db']['dbhost'].';dbname='.$config['db']['dbname'],$config['db']['dbuser'], $config['db']['dbpassword'], false);

    if(!App::$db::testConnection()) throw new Exception("Проблемы с подключением к базе данных.");
}


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
define('APP', App::$path);//ВРОДЕ НЕ НУЖНО, ЕСЛИ НЕ ИСПОЛЬЗУЕТСЯ - УБРАТЬ!

require_once App::$path . '/index.php';

// Вызов Router
$router = new Router();
$router->run();