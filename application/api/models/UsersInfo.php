<?php

namespace application\api\models;

use application\core\ModelApi;

class UsersInfo extends ModelApi
{
    // Личные данные пользователя
    public function getById($id)
    {
        $sql    = "SELECT Name, Surname, Matern, DateOfBirth, YD 
        FROM users_info 
        WHERE id=:id";

        $result = $this->db->row($sql, 
                array("id" => $id));
        
        return $result;
    }


    public function update($mas) {
        $sql    = "UPDATE users_info
        SET Name=:Name, Surname=:Surname, 
        Matern=:Matern, DateOfBirth=:DateOfBirth, YD=:YD
        WHERE id=:id";

        $result = $this->db->query($sql, $mas);
        
        return;
    }
}