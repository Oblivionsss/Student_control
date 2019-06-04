<?php // Модель работы с данными сущности groups_id

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

    // Список всех групп
    public function getAll()
    {
        $sql    = "SELECT id, NameOfGrups
        FROM groups_id";
        
        $result = $this->db->row($sql);

        return $result;
    }

    // Список групп, по которым существует 
    // учетная карточка по данному преподавателя
    public function getAllUniq($mas)
    {
        $sql    = "SELECT DISTINCT teach_group_disc.id_group, groups_id.NameOfGrups  
        FROM teach_group_disc
        INNER JOIN groups_id
        ON teach_group_disc.id_group = groups_id.id
        WHERE teach_group_disc.id_teach = :id";

        $result = $this->db->row($sql, $mas);

        return $result;
    }
}