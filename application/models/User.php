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



    // Добавляем расписание
    public function addRasp()
    {
        $tablename_prot = "id_" . $_POST['group_id'];
        $tablename_ind  = $tablename_prot . "_" . $_POST['disc_id'];
        
        //Добавляем расписание в id_group_disc_teach 
        $result = $this->db->query("UPDATE id_group_disc_teach
        SET dateAdd=:date, rep=:rep
        WHERE id_group=:id_group
        AND id_disc=:id_disc",
        array ('date'   => $_POST['date'],
        'rep'       => $_POST['radio'],
        'id_group'  => $_POST['group_id'],
        'id_disc'   => $_POST['disc_id']
    ));
    
    // Полуаем список id-студентов из групп-прототипов 
    // для обновления sиндивидуальных групп 
    $stud_id = $this->db->row("SELECT id_students
        FROM " . $tablename_prot);


    // Обновляем данные индивидуальных групп
    // Добавляя записи datatime * id_students

    // определяем перую дату
    $data  = $_POST['date'];

    // определяем интервал повтора занятий
    $up         = "2019-05-31";  // коонец семестра
    $repeat     = '';

        if ($_POST['radio'] == 0) {
            $repeat = '+ 1 WEEK';
        }
        else $repeat = '+2 WEEK';

        // заполняем таблицу - уникальную группу данными
        while ($data <= $up) 
        {
            // Перебираем все id
            foreach ($stud_id as $key => $value) {
                $this->db->query("INSERT INTO " . $tablename_ind . "(
                datetime, id_students)
                VALUES (:date, :id)",
                array('date'  => $data,
                'id'    => $value['id_students'] ));  
            }

            // Добавляем период
            $data = date('Y-m-d', strtotime($repeat, strtotime($data)));         
        }

        // echo "<pre>";
        //     echo $value['id_students'];
        // echo "</pre>";
        
        // echo $_POST['date'];

        
        // $date = strtotime('+5 WEEK', strtotime($_POST['date']));
        // $newDate = date('Y-m-d', $date);
        // echo "<br>" . $newDate;
        // // Обновляем индивидуальные группы
        
        return "Расписание обновлено";
    }

    public function getListStud ($gr, $ds) {
        $table  = "id_" . $gr; 
        $result = $this->db->row("SELECT student_list.Name, student_list.Surname, " . 
        $table . ".id_students 
        FROM " . $table . 
        ", student_list
        WHERE student_list.id = ". $table . ".id_students");

        return $result;
    }


    // Получаем список по студентам 
    // Данные за 5 последних записей до сегодняшего дня 
    // Данные за 5 + записей с сегодняшнего числа - если существуют  

    public function getData()
    {   
        // Подготовим данные
        $group_id   = $_GET['group_id'];
        $disc_id    = $_GET['disc_id'];

        // Получаем сегодняшнюю дату
        $today      = date("Y-m-d"); 
        
        // Получаем дату добавления предмета   
        $lowerDefault= $this->db->column("SELECT dateAdd
        FROM id_group_disc_teach
        WHERE id_teach = :id_teach
        AND id_group = :id_group
        AND id_disc  = :id_disc",
        array('id_teach'    => $_SESSION['id'],
            'id_group'      => $group_id,
            'id_disc'       => $disc_id));

        

            
        // Имя таблицы
        $tablename = "id_" . $group_id . "_" . $disc_id;
            
        // Верхняя граница по умочанию
        $up         = "2019-05-31"; 
        // Нижняя граница по умолчанию
        $lower      = $lowerDefault;
        // Верхняя граница дат фактическая  
        $uppDefault = $this->db->column("SELECT DISTINCT datetime
        FROM " . $tablename . 
        " ORDER BY datetime DESC 
        LIMIT 1");

        // Ограничения на выборку 
        $limit = 5;

        // Сортировка выборки по умолчанию в порядке убывания
        $sort = "DESC";

        // Подготовка sql-запроса
        $sql = "SELECT DISTINCT datetime 
        FROM " . $tablename . 
        " WHERE datetime between '" . $lower . 
        "' and '" . $up . 
        "' ORDER BY datetime ". $sort . 
        " LIMIT " . $limit;

        
        // Рассчет нижней выборки
        // Получаем последние даты до сегодняшнего дня
        // Если дата обращения >= даты выборки
        if ($today      >= $lower) {
            // Верхняя граница - сегодняшняя дата
            $up         = $today;
            

            // 
            $sql = "SELECT DISTINCT datetime 
            FROM " . $tablename . 
            " WHERE datetime between '" . $lower . 
            "' and '" . $up . 
            "' ORDER BY datetime ". $sort . 
            " LIMIT " . $limit;
            // 


            $databefore = $this->db->row($sql); 
            
            // Проверяем факт. строк 
            $rowBefore  = count($databefore);

            // Добавим недостающее количество данных по выборке
            // В выборку после нашей даты 
            if ($rowBefore < 5) {
                $limit  = 5 - $rowBefore;
            }
        }
        else {
            // Иначе выдаем все ближайшие 10 дат
            // $up == верхняя граница выборок
            $sort   = "ASC";
            $up     = $uppDefault;
            $limit  = 10;
            

            // 
            $sql = "SELECT DISTINCT datetime 
            FROM " . $tablename . 
            " WHERE datetime between '" . $lower . 
            "' and '" . $up . 
            "' ORDER BY datetime ". $sort . 
            " LIMIT " . $limit;
            // 
            

            $data   = $this->db->row($sql);
            asort($data);
            return $data;
        }

        
        // Теперь получаем все даты верхней границы
        // Если дата запрос <= фактической границы семестра
        if ( date('Y-m-d', strtotime("+1 DAY", strtotime($today))) <= $uppDefault ) {
            
            // Меняем метод сортировки
            $sort   = "ASC";
            // Нижняя граница - сегодняшняя дата
            $lower  = $today;
            // Верхняя граница - факт.граница сема
            $up     = $uppDefault;
            
            $limit  = 5 + $limit ;            


            //
            $sql = "SELECT DISTINCT datetime 
            FROM " . $tablename . 
            " WHERE datetime between '" . $lower . 
            "' and '" . $up . 
            "' ORDER BY datetime ". $sort . 
            " LIMIT " . $limit;
            // 
            

            // Получаем даты 
            $dateafter  = $this->db->row($sql);
        }
        else {
            // Иначе выдаем последние 10 дат 
            $sort   = "DESC";
            $lower  = $lowerDefault;
            $up     = $uppDefault;
            $limit  = 10;
            

            // 
            $sql = "SELECT DISTINCT datetime 
            FROM " . $tablename . 
            " WHERE datetime between '" . $lower . 
            "' and '" . $up . 
            "' ORDER BY datetime ". $sort . 
            " LIMIT " . $limit;
            // 


            $data   = $this->db->row($sql);  
            asort($data);
            return $data;
        }
        // Объединим получившиеся данные
        $date = array_merge($databefore, $dateafter);
        
        // Сортируем в порядке возрастания
        asort($date);
        return $date;
    }


    public function getAllData($data) 
    {
        // Определяем верхние и нижние значения массива
        $lower = NULL;
        $upper = NULL;
        foreach($data as $arr)
        {
            foreach($arr as $key => $value)
            {
                if ($key == 'datetime' && ($value >= $upper))
                {
                    $upper = $value;
                }
            }
        }

        $lower     = $upper;
        
        foreach($data as $arr)
        {
            foreach($arr as $key => $value)
            {
                if ($key == 'datetime' && ($value <= $lower))
                    $lower = $value;
            }
        }

        // Имя таблицы 
        $tablename  = "id_" . $_GET['group_id'] . "_" . $_GET['disc_id'];
        
        // Запрос, который возвращает все данные за нужный период 
        $sql    = "SELECT datetime, id_students, status FROM " . $tablename .
        " WHERE datetime between '" . $lower .
        "' and '" . $upper ."'" .
        " ORDER BY id_students, datetime ASC";
        
        $date   = $this->db->row($sql);
        
        $result = array();
        // Группируем данные по датам
        foreach($date as $key => $val)
        {
            $result[$val['id_students']][] = $val;
        } 

        return array($data, $result);
    }
}