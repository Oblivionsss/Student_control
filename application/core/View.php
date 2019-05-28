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
        extract($vars);

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
    // Ansver sends Client
    public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}


    // Create location redirect
    // for clients
	public function location($url) {
		exit(json_encode(['url' => $url]));
    }
    

    // Возврат списка студентов
    public function updateTableStudentList($list) {
        $mas    = array();
        // Преобразуем данные для клиента
        // в вид id-дисциплины => name - дисциплины
        if (!empty($list)) {

            foreach ($list as $key=> $value) {
                $mas[] = array ('Name' => $value['Name'],
                    'Surname'   => $value['Surname']);
            }


            exit(json_encode(array( 'type' => 'succes',
                                    'list' => $mas)));
        }


        exit(json_encode(['type' => 'error']));
        // exit(json_encode(['status' => $status, 'message' => $message]));
    }


    // Возврат дат
    public function updateDateTableStudent($date) {
        $mas    = array();
        // Преобразуем данные для клиента

        if (!empty($date)) {

            foreach ($date as $key=> $value) {
                $mas[] = array ('datetime' => $value['datetime']);
            }

            exit(json_encode(array( 'type' => 'succes',
                                    'date' => $mas)));
        }


        exit(json_encode(['type' => 'error']));
    }
    

    // Ответ для подгрузки данных в списках 
    public function selectUpdate($disc) {
        $mas    = array();


        // Преобразуем данные для клиента
        // в вид id-дисциплины => name - дисциплины
        if (!empty($disc)) {

            foreach ($disc as $key=> $value) {
                $mas[] = array ('id_disc' => $value['id_disc'],
                    'Name' => $value['Name']);
            }

            exit(json_encode(array( 'type' => 'succes',
                                    'disc' => $mas)));
        }


        exit(json_encode(['type' => 'error']));
        // exit(json_encode(['status' => $status, 'message' => $message]));
    }


    public function updateDate($date)
    {
        exit(json_encode($date));
    }

}