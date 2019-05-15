<?php

namespace application\core;

use application\lib\Db;

class Cookie 
{
    // Прописываем cookie
    public static function setCookie($key, $login) 
    {
        if (self::addCookieBase($key, $login)) {     // Обновляем данные пользователя
        
            setcookie('id', $login, time() + (60 * 60 * 24 * 7));          // Логин на 7 дней
            setcookie('key', $key, time() + (60 * 60 * 24 * 7));           // ключ на 7 дней
            return true;
        }
        else return false;
    }


    // Генерация случайного ключа
    public static function generateSalt()
    {
        $salt           = '';
        $saltLength     = 8;                    // длина соли
        
        for($i = 0; $i < $saltLength; $i++) {
            $salt .= chr(mt_rand(33, 126));     // символ из ASCII-table
        }
    
        return $salt;
    }

    
    // Добавление cookie в бд
    public static function addCookieBase ($key, $login)
    {
        $db     = new Db;

        $sql    = "UPDATE users SET cookie=:cookie WHERE login=:login";
        $db->query($sql, array('login' => $login,
                                'cookie' =>$key));

        return true;
    }
}