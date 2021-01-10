<?php

namespace Component;

/**
 * Класс Router
 * Компонент для работы с маршрутами
 */
class Router
{

    /**
     * Свойство для хранения массива роутов
     * @var array
     */
    private $routes;

    /**
     * Конструктор
     */
    public function __construct()
    {
        // Путь к файлу с роутами
        $routesPath = App::$path . '/config/routes.php';

        // Получаем роуты из файла
        $this->routes = include($routesPath);
    }

    /**
     * Возвращает строку запроса
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $url_request_app = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
            if(array_key_exists($url_request_app[0], App::$apps) && $url_request_app[0] !== ''){
                array_shift($url_request_app);
                return $this->sortURI(trim(implode('/', $url_request_app), '/'));
            }
            return $this->sortURI(trim($_SERVER['REQUEST_URI'], '/'));
        }
    }

    /**
     * Метод для удаления параметра из url и добавления параметров в объект приложения
     */
    private function sortURI($url)
    {
        $uri = explode('?', $url)[0];
        App::$get = $_GET;
        App::$post = $_POST;
        App::$files = $_FILES;
        return $uri;
    }

    /**
     * Метод для обработки запроса
     */
    public function run()
    {
        // Получаем строку запроса
        $uri = $this->getURI();

        // Проверяем наличие запроса в массиве маршрутов (routes.php)
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                $result = $this->useControllerAction($controllerName, $actionName, $parameters);
                if ($result) {
                    break;
                }
            }
        }
        if (!isset($result)) {
            $segments = explode('/', $uri);
            if($this->checkDefaultContoller($segments[0])){
                $controllerName = 'Site' . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                $this->useControllerAction($controllerName, $actionName, $parameters);
            }
            else{
                $controllerName = array_shift($segments);
                if(empty($controllerName)){
                    $controllerName = ucfirst('site' . 'Controller');
                }else{
                    $controllerName = ucfirst($controllerName . 'Controller');
                }
                $actionName = 'action' . ucfirst(array_shift($segments));
                if('action' === $actionName){
                    $actionName = $actionName.'Index';
                }
                $parameters = $segments;
                $this->useControllerAction($controllerName, $actionName, $parameters);
            }
        }
    }

    /**
     * Метод для проверки существования экшена в контроллере
     */
    public function checkDefaultContoller($segment)
    {
        $controllerFile = App::$path . '/controllers/SiteController.php';
        if (file_exists($controllerFile)) {
            include_once($controllerFile);
            $controller = new \SiteController();
            $action = 'action' . ucfirst($segment);
            if(method_exists($controller, $action)){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    /**
     * Использование экшенов в контроллере
     */
    public function useControllerAction($controller, $action, $parameters)
    {
        $controllerFile = App::$path . '/controllers/' . $controller . '.php';
        if (file_exists($controllerFile)) {
            include_once($controllerFile);
            $controllerObject = new $controller;
            call_user_func_array(array($controllerObject, $action), $parameters);
            return true;
        }
        return false;
    }

}
