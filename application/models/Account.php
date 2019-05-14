<?php

namespace application\models;
use application\core\Model;


class Account extends Model
{   
    public function addNewUser()
    {
        $result = $this->db->add("INSERT INTO users
        (login, password) VALUES (:login, :password)", $this->params);
        if ($result) 
            return $result;
        else return false;
    }
}
