<?php

namespace application\core;

use application\core\View;

use application\lib\Auth;


abstract class Controller 
{    
    public $view;
    public $route;

    // Реалзиация прав доступа и проверки авторизации
    public function __construct($route) 
    {
        $this->route    = $route;

        // Проверка авторизации
        $auth   = Auth::checkAuth($this->route);
        // Если возврат ошибки, отображаем её 
        
        if ($auth === '404') {
            View::errorCode(404);
            exit;
        }
        // для авторизированной группы
        else if ($auth  === 'A') {
            $_SESSION['id'] = Auth::getId()[0]['ID'];
        }
        
        // Загрузка представления и модели
        $this->view     = new View($route);
        $this->model    = $this->loadModel($route['controller']);
    }


    // Подключение модели 
    public function loadModel($name) {
        $path = 'application\models\\'.ucfirst($name);
        
		if (class_exists($path)) {
			return new $path;
		}
    }
}