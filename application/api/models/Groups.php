<?php // Модель работы с данными сущности disciplyne

namespace application\api\models;

use application\core\ModelApi;

class Groups extends ModelApi
{
    // Проверка уникальности группы в бд
    public function checkUniq($mas)
    {
        $sql    = "SELECT id 
        FROM groups_id
        WHERE NameOfGrups=:namegr";        
        
        $result = $this->db->row($sql, $mas);

        return $result;
    }

    // Добавление группы
    public function addGroup($mas)
    {
        $sql    = "INSERT INTO groups_id(NameOfGrups, Course, Step) 
        VALUES (:namegr, :course, :step)";

        $result = $this->db->add($sql, $mas);

        return;
    }
}