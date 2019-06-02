<?php

namespace application\core;
use application\core\View;
use application\core\RouterApi;

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

    // Add action and controller
    // in {$routes}
    public function add($route, $param)
    {
        $route  = '#^' . $route;
        $this->routes[$route] = $param;
    }

    // Search pattern in current URI
    public function match()
    {
        $url    = $_SERVER['REQUEST_URI'];
        $url    = trim($_SERVER['REQUEST_URI'], '/');       // Обрезка лишнего в строке URL

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
                    View::errorCode(404);
                }
            }

            else {
                View::errorCode(404);            
            }
        }

        else {
            // Проверка на api
            if (preg_match('#^/api#', $_SERVER['REQUEST_URI'], $matches)) {
                
                // Передаем данные роутов
                $api    = new RouterApi();
                $api->run();
            }
            else 
                View::errorCode(404);
        }
    }
}