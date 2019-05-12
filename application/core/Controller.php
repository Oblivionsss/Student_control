<?php

namespace application\core;

use application\core\View;

abstract class Controller 
{    
    public $route;
    public $view;


    // Save route in local variable
    public function __construct($route) 
    {
        $this->route    = $route;
        $this->view     = new View($route);
    }
}