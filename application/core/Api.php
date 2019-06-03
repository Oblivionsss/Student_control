<?php

namespace application\core;

use application\config\db;

use Exception;
use RuntimeException;

abstract class Api
{
    // Сущность с которой будем работать
    public $apiName = ''; 

    // Метод обработки данных
    //  GET|POST|PUT|DELETE
    protected $method = ''; 

    // Текущий URI
    public $requestUri = [];

    // Набор поступивших параметров
    public $requestParams = [];

    //Название метод для выполнения
    protected $action = ''; 
    
    // Уникальный id пользователя
    protected $id = '';

    // Модель для работы с бд
    protected $model;

    public function __construct($name) {
        // header("Access-Control-Allow-Orgin: *");
        // header("Access-Control-Allow-Methods: *");
        // header("Content-Type: application/json");

        // Для начала проверим доступ
        if (isset ($_SESSION['authorize']) ) {
            $this->id   = $_SESSION['id']; 
        } 
        // Если доступа нет, значит мы не авторизованны
        // Доступ к ресурсам API заблокирован
        else {
            $this->response("Ограничение прав доступа", 403);
            exit;
        }
        //Массив GET параметров разделенных слешем
        $this->requestUri   = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
        $this->requestParams = $_REQUEST;


        // Подключение модели 
        $this->model = $this->loadModel($name);

        //Определение метода запроса
        $this->method = $_SERVER['REQUEST_METHOD'];

        if ($this->method == 'POST' && isset($this->requestParams['method'])) {
            
            if ($_REQUEST['method'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_REQUEST['method'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
    }

    public function run() {
        //Первые 2 элемента массива URI должны быть "api" и название таблицы
        if(array_shift($this->requestUri) !== 'api' || array_shift($this->requestUri) !== $this->apiName){
            throw new Exception('API Not Found', 404);
        }
        //Определение действия для обработки
        $this->action = $this->getAction();

        //Если метод(действие) определен в дочернем классе API
        if (method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }

    protected function response($data, $status = 500) {
        // header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        exit(json_encode(['status' => $status, 
                    'data'     => $data]));
    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }

    protected function getAction()
    {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                if($this->requestUri){
                    return 'viewAction';
                } else {
                    return 'indexAction';
                }
                break;
            case 'POST':
                return 'createAction';
                break;
            case 'PUT':
                return 'updateAction';
                break;
            case 'DELETE':
                return 'deleteAction';
                break;
            default:
                return null;
        }
    }


    // Загрузка модели 
    public function loadModel($name) {
        $path = 'application\api\models\\'. $name;
        
		if (class_exists($path)) {
			return new $path;
        }
        else {
            throw new RuntimeException('Method not exist', 405);
        }
    }


    abstract protected function indexAction();
    abstract protected function viewAction();
    abstract protected function createAction();
    abstract protected function updateAction();
    abstract protected function deleteAction();
}