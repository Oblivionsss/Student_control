<?php

namespace application\core;

class View 
{    
    public $path;
    public $route;
    public $layout = 'default';


    // Save routes
    // Create uri of view
    public function __construct($route) 
    {
        $this->route    = $route;
        $this->path     = $this->route['controller'] . '/' . $this->route['action'];
    }


    // Save in locals veriable
    // main content 
    public function render($title, $vars=[])
    {
        $link   = 'application/views/'. $this->path . '.php';

        if (file_exists($link)) {
            ob_start();
            require $link;
            $content    = ob_get_clean();
            require 'application/views/layouts/'. $this->layout . '.php';
        }

        else echo "Вид не найден";
    }


    // Redirect function  
    public function redirect($url)
    {
        header ('location: ' . $url);
    }


    // Create errors Page
    public static function errorCode ($errors) 
    {
        http_response_code($errors);
        $path   = 'application/views/errors/' . $errors . '.php';
        if (file_exists($path)) {
            require $path;
        }    
    }

    
    // Create messege ansver 
    // ansver sends Client
    public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}


    // Create location redirect
    // for clients
	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

}