<?php

namespace application\models;
use application\core\Model;
use application\lib\Hash;


class Account extends Model
{   
    // Добавление нового пользователя в БД
    public function addNewUser($login)
    {
        $this->params['password']  = Hash::hash($this->params['password']);
        
        $result = $this->db->add("INSERT INTO users
        (login, password) VALUES (:login, :password)", $this->params);
        if ($result) 
            return $result;
        else return false;
    }



    
}
