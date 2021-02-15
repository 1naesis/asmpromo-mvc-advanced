<?php

namespace Component;

/**
 * Класс Widgets
 * Компонент приложения для управления виджетами
 */
class Widgets
{
    public static function widget(array $args = [])
    {
        $class_widget = get_called_class();
        $widget = new $class_widget();
        foreach ($args as $key => $arg){
            if(!property_exists($widget, $key))throw new \Exception("Используемый виджет не содержит переданный параметр.");
            $widget->$key = $arg;
        }
        $segment_class = explode("\\", $class_widget);
        $path = [];
        for($i = 0; $i < count($segment_class)-1; $i ++){
            $path[] = strtolower($segment_class[$i]);
        }
        $widget->path = implode("/", $path);
        return $widget->run();
    }

    protected function render($path, $parameters)
    {
        extract($parameters, EXTR_SKIP);
        include ROOT.'/common/'.$this->path.'/views/'.$path.'.php';
    }
}