<?php // Модель работы с данными сущности disciplyne

namespace application\api\models;

use application\core\ModelApi;

class Disciplyne extends ModelApi
{
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
}