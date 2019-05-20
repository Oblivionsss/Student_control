<?php

namespace application\models;
use application\core\Model;
use application\lib\Hash;


class Account extends Model
{   
    // Добавление нового пользователя в БД
    public function addNewUser()
    {
        $this->params['password']  = Hash::hash($this->params['password']);

        // Добавление teach_id
        $result = $this->db->add("INSERT INTO teach_id(login, password) 
        VALUES (:login, :password)",
        $this->params);

        // Создаем teach_info
        $result = $this->db->query("INSERT INTO teach_info(id) 
        VALUES (:id)",
        array('id' => $result));

        if ($result) 
            return $result;
        else return false;
    }




    
}
