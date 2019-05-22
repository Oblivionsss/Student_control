<?php

namespace application\lib;

// use application\lib\Db;
use application\lib\Hash;

class ValidationCreate
{
    public static function checkDate($action)
    {
        // $db = new Db;
        
        $hint  = '';               // Подсказка


        // if (isset($_SESSION[''])) {
        //     $id = $this->db->row("SELECT ID 
        //     FROM teach_id 
        //     WHERE login=:login", 
        //     array("login" => $_SESSION['login_user']));
        // } else return "Ошибка добавления данных, перезагрузите страницу, пожалуйста";
        
        
        // Проверка формы
        if ($action == 'disc') {
            // Проверка на пустоту названия дисциплины
            if (!empty($_POST["NameDisc"])) {
                $disc   = $_POST["NameDisc"];
            } else return "Вы не ввели название дисциплины";
            
            // Проверка на пустоту количество часов дисциплины
            if (!empty($_POST['CountHours'])) {
                $hours  = $_POST['CountHours'];   
            } else return "Вы не ввели количество часов \n";
            
            return $hint;
        }

        if ($action == 'group') {
            // Проверка на пустоту названия дисциплины
            if (!empty($_POST["nameGroups"])) {
                $disc   = $_POST["nameGroups"];
            } else return "Вы не ввели название группы";
            
            // Проверка на пустоту количество часов дисциплины
            if (!empty($_POST['Course'])) {
                $hours  = $_POST['Course'];   
            } else return "Вы не указали курс\n";
            
            if (!empty($_POST['level'])) {
                $hours  = $_POST['level'];   
            } else return "Вы не указали уровень образования\n";
            
            return $hint;
        }

    }
}