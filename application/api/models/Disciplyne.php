<?php // Модель работы с данными сущности disciplyne

namespace application\api\models;

use application\core\ModelApi;

class Disciplyne extends ModelApi
{
    // Добавляем дисциплину
    public function addDisc ($mas)
    {
        $sql = "INSERT INTO disciplyne(teach_id, Name, Hours) 
        VALUES (:teach_id, :name, :hours)";

        $result = $this->db->add($sql, $mas);
                
        if ($result) {
            return true;
        }
        return false;
    }

    // Получаем все дисциплины
    public function getAll()
    {
        $sql    = "SELECT id, Name
        FROM disciplyne";
        
        $result = $this->db->row($sql);

        return $result;
    }
}