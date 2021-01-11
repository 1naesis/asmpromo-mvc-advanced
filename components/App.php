<?php

namespace Component;

use Component\Router;

/**
 * Класс App
 * Компонент приложения
 */
class App
{
    static public $root = null;
    static public $path = null;
    static public $apps = null;
    static public $get = null;
    static public $post = null;
    static public $files = null;
    static public $db = null;

    public static function run(){
        $router = new Router();
        $router->run();
    }
}

?>