<?php

namespace application\core;
use application\core\View;

abstract class Controller 
{    
    public $ar; 
    public $view;
    public $route;  


    // Save route in local variable
    public function __construct($route) 
    {

        $this->route    = $route;

        // if (!$this->checkAr()) {
        //     View::errorCode(404);
        //     exit;
        // }
        
        $this->view     = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    
    public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}


    // Check acces rules
    public function checkAr()
    {
        $this->ar   = require 'application/ar/' . $this->route['controller'] . '.php';
        
        // Check rules for different groups users
        if ( ($this->Ar('all')) or
            (isset($_SESSION['auth']['id']) and $this->Ar('auth')) or
            (!isset($_SESSION['auth']['id']) and $this->Ar('guest')) or
            (!isset($_SESSION['admin']['token']) and $this->Ar('admin')) ) {
            return true;
        }   

        // elseif (isset($_SESSION['auth']['id']) and $this->Ar('auth')) {
        //     return true;
        // }

        // elseif (!isset($_SESSION['auth']['id']) and $this->Ar('guest')) {
        //     return true;
        // }

        // elseif (!isset($_SESSION['admin']['token']) and $this->Ar('admin')) {
        //     return true;
        // }

        else return false;
    }


    // Check presence rules
    // for this page
    // in mass with conf.-rules-contr.
    public function Ar($str)
    {
        return in_array($this->route['action'], $this->ar[$str]);
    }  
}