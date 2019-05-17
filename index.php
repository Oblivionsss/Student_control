<?php

    //   FONT PAGE    //
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    use application\core\Router;
    use application\lib\Db;

    spl_autoload_register(function ($class) {
        // include 'classes/' . $class . '.class.php';
        $path   = str_replace('\\', '/', $class . ".php");
        if (file_exists($path)) {
            require $path;
        }
    });
    session_start();

    $router     = new Router;
    $router->run();