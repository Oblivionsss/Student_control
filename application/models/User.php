<?php

namespace application\models;
use application\core\Model;
use application\core\View;

use application\lib\ValidationCreate;

class User extends Model 
{
    // Данные для контроллера настройки
    public function getUserInfo($login)
    {
        // $this->db - метод класса app.\lib\Db
        $result = $this->db->row("SELECT Name, Surname, Matern, DateOfBirth 
        FROM teach_id 
        INNER JOIN teach_info 
        ON teach_id.ID = teach_info.id 
        WHERE login=:login", 
        array("login" => $login));
        
        return $result;
    }


    // Функция добавления новой дисциплины
    public function addDisc($change)
    {
        if(!empty($_POST)) {
            $result     = ValidationCreate::checkDate($change);

            // Если нашли ошибку в валидации, возвращаем её в контроллер
            if ($result != '') {
                return $result;
            }

            // Иначе
            else {
                // Добавляем новую дисциплину в disciplyne
                // echo"qq";
                $result = $this->db->add("INSERT INTO disciplyne(teach_id, Name, Hours) 
                VALUES (:teach_id, :name, :hours)",
                array('teach_id'  => $_SESSION['id'],
                'name'      => $_POST['NameDisc'],
                'hours'     => $_POST['CountHours']));
                
                if ($result) {
                    return "Дисциплина успешно добавлена!";
                }
                else return "Ошибка при добавлении дисциплины";
            }
        }
        else return "//";
    }

    public function addGroup($change)
    {
        if(!empty($_POST)) {
            $result     = ValidationCreate::checkDate($change);

            // Если нашли ошибку в валидации, возвращаем её в контроллер
            if ($result != '') {
                return $result;
            }

            // Иначе
            else {
                // Добавляем новую группу
                // echo"qq";
                // Делаем запрос на существование группы
                // Если группы нет такой
                // Добавляем, получаем id
                // Добавляем группу-список студентов с использованием в названии id 
                $result = $this->db->query("INSERT INTO groups_id (NameOfGrups, Course, Step) 
                VALUES (:namegr, :course, :step)",
                array('namegr'  => $_POST['nameGroups'],
                'course'        => $_POST['Course'],
                'step'          => $_POST['level']));
                
                var_dump($result);
                if ($result->errorCode()) {
                    return "Ошибка, такая группа уже существует";
                }
                
                else return "Группа успешно добавлена!";
            }
        }
        else return "//";
    }

    // public function addUserInfo

    
}