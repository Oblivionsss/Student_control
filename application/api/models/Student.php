<?php // Модель работы с данными сущности student

namespace application\api\models;

use application\core\ModelApi;


class Student extends ModelApi
{
    // Добавление студента
    public function addStud($mas)
    {
        $sql = "INSERT INTO student_list(Name, Surname, id_group) 
        VALUES (:nameSt, :nameSn, :groups)";

        $result = $this->db->query($sql, $mas);
                
        return;
    }

    // Получение списка id-студентов по id-groups
    public function getStudGroupsId($mas) 
    {
        $sql = "SELECT id
        FROM student_list
        WHERE id_group=:id_group";

        $result =  $this->db->row($sql, $mas);

        return $result;
    }

    // Получение списка id-студентов, их ФИО по id-groups
    public function getAllStudGroupsId($mas) 
    {
        $sql = "SELECT id, Name, Surname
        FROM student_list
        WHERE id_group=:id_group";

        $result =  $this->db->row($sql, $mas);

        return $result;
    }

    // 
}