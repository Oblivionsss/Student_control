<?php

namespace application\models;
use application\core\Model;

class User extends Model 
{
    public function getUserInfo($login)
    {
        // $thi->db - метод класса app.\lib\Db
        $result = $this->db->row("SELECT Name, Surname, Matern, DateOfBirth 
        FROM teach_id 
        INNER JOIN teach_info 
        ON teach_id.ID = teach_info.id 
        WHERE login=:login", 
        array("login" => $login));
        
        return $result;
    }


    // public function addUserInfo

    
}