<?php

namespace application\core;

class View 
{    
    public $path;
    public $route;
    public $layout = 'default';


    // Сохранение роутера
    // Формирование URI 
    public function __construct($route) 
    {
        $this->route    = $route;
        $this->path     = $this->route['controller'] . '/' . $this->route['action'];
    }


    // Локальные переменные 
    // main content 
    public function render($title, $vars=[])
    {
        extract($vars);

        $link   = 'application/views/'. $this->path . '.php';
        
        // Подготовка содержания
        if (file_exists($link)) {
            ob_start();
            require $link;
            $content    = ob_get_clean();
            require 'application/views/layouts/'. $this->layout . '.php';
        }

        // ?
        else echo "Вид не найден";
    }


    // Перенаправление  
    public function redirect($url)
    {
        header ('location: ' . $url);
    }


    // Форма вывода страницы ошибки
    public static function errorCode ($errors) 
    {
        http_response_code($errors);
        $path   = 'application/views/errors/' . $errors . '.php';

        if (file_exists($path)) {
            require $path;
        }    
    }

    
    // Формирование ответа 
    // для клиента
    public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}


    // Формирование UTI для редиректа
    // Для отправки на клиент
	public function location($url) {
		exit(json_encode(['url' => $url]));
    }
    

    // Возврат списка студентов
    // users/student
    public function updateTableStudentList($list) {
        $mas    = array();
        
        // Преобразуем данные для клиента
        // в вид id-дисциплины => name - дисциплины
        
        if (!empty($list)) {

            foreach ($list as $key=> $value) {
                $mas[] = array ('Name'  => $value['Name'],
                        'Surname'       => $value['Surname'],
                        'id_students'   => $value['id_students']);
            }

            exit(json_encode(array( 'type' => 'succes',
                                    'list' => $mas)));
        }

        exit(json_encode(['type' => 'error']));

    }


    // Возврат строки дат
    // для формирования таблицы посещаемости
    // users/student 
    public function updateDateTableStudent($date) {
        $mas    = array();  // Массив для данных по посещаемости
        $mas_1  = array();  // Массив для данных по датам
        
        // Преобразуем данные для клиента
        if (!empty($date)) {
            // Формирование основных данных посещаемости
            foreach ($date[1] as $key=> $value) {
                $mas[] = array ($key => $value);
            }
            
            // Упаковка данных по датам
            foreach ($date[0] as $key=> $value) {
                $mas_1[] = array ('datetime' => $value['datetime']);
            }

            // var_dump($date);
            exit(json_encode(array( 'type'      => 'succes',
                                    'infoStud'  => $mas,
                                    'date'      => $mas_1)));
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