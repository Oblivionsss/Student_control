<?php

namespace application\models;
use application\core\Model;

class User extends Model 
{
    public function getUserInfo()
    {
        // $thi->db - метод класса app.\lib\Db
        $result = $this->db->row("SELECT login, password FROM users WHERE :id", array("id" => "1"));
        return $result;
    }
}