<?php   // Модель работы с данными сущности // // student_control_id

namespace application\api\models;

use application\core\ModelApi;

class StudentControl extends ModelApi
{
    public function addAction($mas)
    {
        $sql    = "INSERT INTO student_control_id(
            id_uniq, id_stud, datetime)
            VALUES (:id_uniq, :id_stud, :date)";
        
        $result = $this->db->query($sql, $mas);

        return;
    }
}
