<?php

namespace application\core;

class View 
{    
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) 
    {
        $this->route    = $route;
        $this->path     = $this->route['controller'] . '/' . $this->route['action'];
        
        var_dump($this->path);
    }
}