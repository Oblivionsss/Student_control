<?php // Модель работы с данными сущности disciplyne

namespace application\api\models;

use application\core\ModelApi;

class Disciplyne extends ModelApi
{
    // Добавляем дисциплину
    public function addDisc ($mas)
    {
        $sql = "INSERT INTO disciplyne(Name, Hours) 
        VALUES  (:name, :hours)";

        $result = $this->db->add($sql, $mas);
                
        if ($result) {
            return true;
        }
        return false;
    }

    // Список всех дисциплины
    public function getAll()
    {
        $sql    = "SELECT id, Name
        FROM disciplyne";
        
        $result = $this->db->row($sql);

        return $result;
    }

    // Вовзврат всех дисциплин доступных для пользователя,
    // по определенной группе
    public function getAllUniq($mas)
    {
        $sql    = "SELECT DISTINCT teach_group_disc.id, disciplyne.Name  
        FROM teach_group_disc
        INNER JOIN disciplyne
        ON teach_group_disc.id_disc = disciplyne.id
        WHERE teach_group_disc.id_teach = :id
        AND teach_group_disc.id_group = :id_group";

        $result = $this->db->row($sql, $mas);

        return $result;
    }


}