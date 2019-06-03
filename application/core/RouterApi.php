<?php
// Определяем нужный контролер для работы с данными 

namespace application\core;

class RouterApi
{
    protected $params   = [];
    protected $route   = [];

    function __construct() 
    {
        $arr    = require 'application/config/routesApi.php';
        
        foreach ($arr as $key => $value)    
            $this->add($key, $value);        
    }

    // Add action and controller
    // in {$routes}
    public function add($route, $param)
    {
        $route  = '#^' . $route;
        $this->route[$route] = $param;
    }

    // Search pattern in current URI
    public function match()
    {
        $url    = $_SERVER['REQUEST_URI'];
        $url    = trim($_SERVER['REQUEST_URI'], '/');       // Обрезка лишнего в строке URL


        foreach ($this->route as $route => $params) {
            
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
            
            // Подключаем контроллер
            $path       = 'application\api\\' . $this->params['controller'];

            if (class_exists($path)){
                
                if (method_exists($path, 'run')) {
                    $controller = new $path($this->params['model']);

                    $controller->run();
                }

            }
            else {
                View::errorCode(404);
            }
        }

        else {
            View::errorCode(404);                        
        }
    }
}