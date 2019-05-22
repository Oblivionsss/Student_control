<?php

    namespace application\lib;
    
    use PDO;        //???????

    class Db
    {
        protected $db;

        // Подключение к бд
        public function __construct()
        {
            $params = require 'application/config/db.php';

            $sql    = "mysql:host={$params['host']};dbname={$params['dbname']}";
            
			$opt    = array(
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			
			try {
                $this->db = new PDO($sql, $params['user'], $params['password'], $opt);
                
			} catch (PDOException $e) {
                var_dump($e->getMessage());
                exit;                
            }       
        }
        

        // Подготовка скьюль запроса
        // Биндим параметры
        public function query($sql, $params = []) {
            $stmt = $this->db->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $val) {
                    $stmt->bindValue(':'.$key, $val);
                }
            }
            $stmt->execute();
            return $stmt;
        }
    

        // Возвращаем ответ
        public function row($sql, $params = []) {
            $result = $this->query($sql, $params);
            return $result->fetchAll();
        }


        // Добавляем нового пользователя//
        // teach_id; teach_info
        public function add($sql, $params = []) {
            $result = $this->query($sql, $params);
            if ($result->errorCode())
                return $result;
            return $this->db->lastInsertId();
        }


        // Проверка существования логина для авторизации
        public function getLogin ($sql, $params = []) {
            $result = $this->query($sql, $params);
            if ($result->fetchAll()) {
                return 1;
            }
            else return 0;
        }


        //Создание таблицы 
        public function createTable($sql, $params = []) {
            $stmt = $this->db->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $val) {
                    $stmt->bindValue(':'.$key, 'id_' . $val);
                }
            }
            $stmt->execute();
            return $stmt;
        }

    }