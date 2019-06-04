<?php

namespace application\api\models;

use application\core\ModelApi;

class UsersInfo extends ModelApi
{
    // Личные данные пользователя
    public function getById($mas)
    {
        $sql    = "SELECT Name, Surname, Matern, DateOfBirth, YD 
        FROM teach_info 
        WHERE id=:id";

        $result = $this->db->row($sql, $mas);
        
        return $result;
    }


    // Обновление личных данных преподавателя
    public function update($mas) {
        $sql    = "UPDATE teach_info
        SET Name=:Name, Surname=:Surname, 
        Matern=:Matern, DateOfBirth=:DateOfBirth, YD=:YD
        WHERE id=:id";

        $result = $this->db->query($sql, $mas);
        
        return;
    }
}