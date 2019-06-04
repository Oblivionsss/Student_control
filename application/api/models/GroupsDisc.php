<?php   // Модель работы с данными сущности teach_groups_disc

namespace application\api\models;

use application\core\ModelApi;

class GroupsDisc extends ModelApi
{
    // Добавляем уникальную связку (id) - teach<->groups<->disc
    // Формируем уникальную карточку дисциплины для группы
    public function addUniq($mas)
    {   
        $sql    = "INSERT INTO teach_group_disc(id_teach, id_group, id_disc)
        VALUES (:id_teach, :id_group, :id_disc)";

        $result = $this->db->query($sql, $mas);

        return;
    }
}