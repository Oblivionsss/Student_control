<?php

namespace application\lib;

class Hash
{
    // Генерация хеш-пароля
    public static function hash($pass)
    {
        return password_hash($pass, PASSWORD_BCRYPT);   // 2-й параметр - метод шифровки
    }


    // Проверка пароля
    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}