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

        if ($action == 'groups') {
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

        if ($action == 'student') {
            // проверка на пустоту имени
            if (!empty($_POST["nameSt"])) {
                $nameSn   = $_POST["nameSt"];
            } else return "Вы не указали имя";
            
            // Проверка на пустоту фамилии
            if (!empty($_POST['nameSn'])) {
                $nameSn  = $_POST['nameSn'];   
            } else return "Вы не указали фамилию\n";
            
            if (!empty($_POST['groups_id'])) {
                $groups  = $_POST['groups_id'];   
            } else return "Вы не указали группу\n";
            
            return $hint;
        }   



        if ($action == 'discgroup') {
            
            // проверка на пустоту имени
            // Добавить проверку на селект value = 0
            if (!empty($_POST["groupselect"]))  {
                $nameSn   = $_POST["groupselect"];
            } else return "Вы не указали группу";
            
            // Проверка на пустоту фамилии
            if (!empty($_POST['discselect'])) {
                $nameSn  = $_POST['discselect'];   
            } else return "Вы не указали дисциплину\n";
                        
            return $hint;
        }

    }
}