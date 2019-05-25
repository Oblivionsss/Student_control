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


    // Добавляем новую дисциплину
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

    // Добавляем новую группу
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

                $namegr     = $_POST['nameGroups'];
                $course     = $_POST['Course'];
                $step       = $_POST['level'];
                
                // Добавляем новую группу
                // echo"qq";
                // Делаем запрос на существование группы
                $result = $this->db->row("SELECT id 
                FROM groups_id
                WHERE NameOfGrups=:namegr",
                array('namegr'  => $namegr));

                if ( !empty($result) ) {
                    return "Такая группа уже существует";
                }

                // Если группы нет такой
                // Добавляем, получаем id
                $result = $this->db->add("INSERT INTO groups_id(NameOfGrups, Course, Step) 
                VALUES (:namegr, :course, :step)",
                array('namegr'  => $namegr,
                'course'        => $course,
                'step'          => $step));
                
                // return "Ошибка, попробуйте снова";


                // Добавляем группу-список студентов с использованием в названии id
                // tablename : Имя группы = "id" + id по groups_id
                // groups_id.id является внешним ключом для tablename  
                $tablename  = "id_" . $result;
                
                $result     = $this->db->query("CREATE TABLE " . $tablename. "(
                id_students INT(11) NOT NULL,
                FOREIGN KEY (id_students) REFERENCES student_list(id) ON DELETE CASCADE )");

                return "Группа добавлена";

                // $result     = $this->db->query("CREATE TABLE " . $tablename. "(
                // date DATE, 
                // id_students INT(11) NOT NULL,
                // vars VARCHAR(70) NOT NULL,
                // FOREIGN KEY (id_students) REFERENCES groups_id(id) ON DELETE CASCADE )");

            }
        }
        else return "//";
    }


    public function addStud()
    {
        if(!empty($_POST)) {
            $result     = ValidationCreate::checkDate('stud');


            // Если нашли ошибку в валидации, возвращаем её в контроллер
            if ($result != '') {
                return $result;
            }

            
            // Добавляем студента в student_list
            // Получаем id студента
            else {
                $result = $this->db->add("INSERT INTO student_list(Name, Surname, id_group) 
                VALUES (:nameSt, :nameSn, :groups)",
                array('nameSt'  => $_POST['nameSt'],
                'nameSn'        => $_POST['nameSn'],
                'groups'        => $_POST['groups_id']));

                // Теперь добавляем студента в группу прототип
                // Подготавливаем переменные для запроса

                $id_stud    = $result;
                $id_groups  = $_POST['groups_id'];

                // Формируем название таблицы
                $tablename  = "id_" . $id_groups;
                $sql = "INSERT INTO " . $tablename. "(id_students)
                VALUES(:id)";
                $result     = $this->db->query($sql,
                array ('id' => $id_stud));

                return "Студент добавлен";
            }

        }
        return "Ошибка добавления, пожалуйста перезагрузите страницу";
    }


    public function addDiscGroup() {
        if(!empty($_POST)) {
            $result     = ValidationCreate::checkDate('discgroup');


            // Если нашли ошибку в валидации, возвращаем её в контроллер
            if ($result != '') {
                return $result;
            }


            else {

                $id_groups  = $_POST['groupselect'];
                $id_disc    = $_POST['discselect'];

                $tablename  = "id_" . $id_groups . "_" . $id_disc;
                $sql        = "SHOW TABLES LIKE '" . $tablename . "'";
                // Проверяем на существование группы
                $check     = $this->db->row($sql);
                
                if ( !empty($check) ) {
                    return "Такая группа уже существует!";
                } 

                // Создаем таблицу id_groups_id_disc
                $result     = $this->db->query("CREATE TABLE " . $tablename. "(
                id INT(11) NOT NULL AUTO_INCREMENT,
                datetime DATE NOT NULL,
                id_students INT(11) NOT NULL,
                status VARCHAR(30),
                dop_parametrs VARCHAR(50),
                PRIMARY KEY (id),
                FOREIGN KEY (id_students) REFERENCES student_list(id) ON DELETE CASCADE )");

                // Добавляем в список групп id_group_disc_teach 
                // закрепляя каждую группу за конкретным преподавателем
                $sql    = "INSERT INTO id_group_disc_teach(id_teach, id_group, id_disc)
                VALUES (:id_teach, :id_group, :id_disc)"; 

                $result = $this->db->query($sql,
                array('id_teach'    => $_SESSION['id'],
                        'id_group'          => $id_groups,
                        'id_disc'           => $id_disc));

                return "Индивидуальная группа добавлена";

            }
        }
        return "Ошибка добавления, пожалуйста перезагрузите страницу";
    }


    public function getGroupsInfo() 
    {
        $result = $this->db->row("SELECT id, NameOfGrups FROM groups_id");
        return $result;
    }

    public function getDiscInfo()
    {
        $result = $this->db->row("SELECT id, Name FROM disciplyne");
        return $result;
    }

    public function getUniqGroupsInfo()
    {
        $result = $this->db->row("SELECT DISTINCT id_group_disc_teach.id_group, groups_id.NameOfGrups  
        FROM id_group_disc_teach
        INNER JOIN groups_id
        ON id_group_disc_teach.id_group = groups_id.id
        WHERE id_group_disc_teach.id_teach = :id",
        array('id'  => $_SESSION['id']));
        
        return $result;
    }


    public function getUniqDiscInfo($id_group)
    {
        $result = $this->db->row("SELECT DISTINCT id_group_disc_teach.id_disc, disciplyne.Name  
        FROM id_group_disc_teach
        INNER JOIN disciplyne
        ON id_group_disc_teach.id_disc = disciplyne.id
        WHERE id_group_disc_teach.id_teach = :id
        AND id_group_disc_teach.id_group = :id_group",
        array('id'  => $_SESSION['id'],
                'id_group'  => $id_group));
        
        return $result;

    }
    
}