<?php

namespace application\core;

use application\core\View;

use application\lib\Auth;


abstract class Controller 
{    
    public $view;
    public $route;

    // Save route in local variable
    public function __construct($route) 
    {
        $this->route    = $route;


        if (Auth::checkAuth($this->route) === '404') {
            View::errorCode(404);
            exit;
        }

        else {
            $_SESSION['id'] = Auth::getId()[0]['ID'];    
            
            $this->view     = new View($route);
            $this->model    = $this->loadModel($route['controller']);
        }
    }


    // Подключение модели 
    public function loadModel($name) {
        $path = 'application\models\\'.ucfirst($name);
        
		if (class_exists($path)) {
			return new $path;
		}
    }
}