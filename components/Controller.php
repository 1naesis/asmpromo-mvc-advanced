<?php

namespace Component;

/**
 * Класс Controller
 * Компонент приложения
 */
class Controller
{
    public $app;

    function __construct()
    {
        $this->app = App::$path;
    }
    protected function render(){

    }
}

?>