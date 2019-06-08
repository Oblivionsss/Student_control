<?php   // Модель работы с данными сущности // // student_control_id

namespace application\api\models;

use application\core\ModelApi;

class StudentControl extends ModelApi
{
    // Добавляем данные - пустышки в таблицу
    public function addAction($mas)
    {
        $sql    = "INSERT INTO student_control_id(
            id_uniq, id_stud, datetime)
            VALUES (:id_uniq, :id_stud, :date)";
        
        $result = $this->db->query($sql, $mas);

        return;
    }


    // Получение верхней границы 
    public function getMaxDate ($mas)
    {
        $sql    = "SELECT DISTINCT datetime
        FROM student_control_id
        WHERE id_uniq=:id_uniq
        ORDER BY datetime DESC 
        LIMIT 1";

        $result = $this->db->row($sql, $mas);

        return $result;
    }


    // Получаем ближайшие 10 дней
    public function getDate($lower, $up, $sort, $limit, $mas) 
    {
        $sql = "SELECT DISTINCT datetime 
        FROM student_control_id " .  
        "WHERE id_uniq=:id_uniq" .
        " AND datetime between '" . $lower . 
        "' AND '" . $up . 
        "' ORDER BY datetime ". $sort . 
        " LIMIT " . $limit;


        $result = $this->db->row($sql, $mas);

        return $result;
    }    


    // Получаем данные за ближайшие 10 дней            
    public function getAllData( $lower, $upper, $mas) 
    {
        $sql    = "SELECT datetime, id_stud, status, id 
        FROM student_control_id " .
        " WHERE id_uniq=:id_uniq" .
        " AND datetime between '" . $lower .
        "' AND '" . $upper ."'" .
        " ORDER BY id_stud, datetime ASC";


        $result = $this->db->row($sql, $mas);

        return $result;
    }




    // Обновляем данные по id
    public function updateData( $mas )
    {
        $sql    = "UPDATE student_control_id
        SET status=:status
        WHERE id=:id";

        $result = $this->db->query($sql, $mas);

        return;        
    }



    // Удаляем день с данными 
    public function deleteData ( $mas )
    {
        $sql    = "DELETE FROM student_control_id
        WHERE id_uniq=:id_uniq
        AND datetime=:days";

        $result = $this->db->query($sql, $mas);

        return;
    }
}
