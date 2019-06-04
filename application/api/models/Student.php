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
}