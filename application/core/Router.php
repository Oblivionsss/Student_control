<?php

namespace application\core;

class Router
{
    protected $routes   = [];
    protected $params   = [];
    function __construct() 
    {
        $arr    = require 'application/config/routes.php';
        
        foreach ($arr as $key => $value)    
            $this->add($key, $value);        
    }

    // add action and controller
    // in {$routes}
    public function add($route, $param)
    {
        $route  = '#^' . $route . '#';
        $this->routes[$route] = $param;
    }

    // Search pattern in currently URI
    public function match()
    {
        $url    = $_SERVER['REQUEST_URI'];
        $url    = preg_replace('#^/mvc/#', '', $url);       // Обрезка лишнего в строке URL

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    // Сontrollers, classes and 
    // method configurations
    public function run()
    {
        if ($this->match()) {
            $path       = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)){
                $action = $this->params['action'] . 'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                }
                else {
                    echo "Не найден экшен";
                }
            }
            else {
                echo "Контроллер не найден " . $path;
            }
        }
        else {
            echo "Не найден маршрут";
        }
    }
}