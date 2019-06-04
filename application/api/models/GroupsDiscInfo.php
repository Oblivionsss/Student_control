<?php   // Модель работы с данными сущности teach_group_disc_info

namespace application\api\models;

use application\core\ModelApi;

class GroupsDiscInfo extends ModelApi
{  
    public function addRasp($mas)
    {
        $sql    = "INSERT INTO teach_group_disc_info(teachdiscgroup, 
        dateAdd, rep, par, lectureHall)
        VALUES (:id, :date, :rep, :par, :hall)";

        $result = $this->db->query($sql, $mas);

        return;
    }
}