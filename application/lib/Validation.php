<?php

namespace application\lib;
use PDO;

class Validation
{
    
    public static function checkPost($action)
    {
        
        $hint  = '';               // Подсказка
        $login;
        $password;
        $confirmPassword;

        if (isset($_POST["login"])) {
            $login     = $_POST["login"];
        }
        
        if (isset($_POST["password"])) {
            $password         = $_POST["password"];
        }

        if (isset($_POST["confirmPassword"])) {
            $confirmPassword     = $_POST["confirmPassword"];
        }


        if ($action == "regist") {
                            
            // Проверка на "пустоту"
            if (empty($login )) {      
                $hint   .= "Вы не ввели логин\n";
                return $hint;
            }
            
            if (empty($password)) {    
                $hint   .= "Вы не ввели пароль\n";
                return $hint;
            }

            if (empty($confirmPassword)) {
                $hint   .= "Вы не ввели повторно пароль\n";
                return $hint;
            } 


            // Проверка на длину 
            if (strlen($login) < 4) { 
                $hint   .= "Логин слишком маленький, длина логина должна быть не меньше 4 символов\n";
            }

            else if (strlen($login) > 20) {
                $hint   .= "Логин слишком большой, длина логина не должна превышать 20 символов\n";
                return $hint;
            }

            if (strlen($password) < 8) { 
                $hint   .= "Пароль слишком маленький, длина пароля должна быть не менее 8 символов\n";
                return $hint;
            }


            else if (strlen($password) > 20) {
                $hint   .= "Пароль слишком большой, длина пароля не должна превышать 20 символов\n";
                return $hint;
            }


            // Проверка на корректность введенных данных
            if (!preg_match('#^[a-z0-9]{4,20}$#i', $login )) {
                $hint   .= "Некорректный логин, используйте латинский алфавит и числовые символы\n";
                return $hint;
            }

            if (!preg_match('#^[a-z0-9]{8,20}$#i', $password )) {
                $hint   .= "Некорректный пароль, используйте латинский алфавит и числовые символы\n";
                return $hint;
            }
            

            // Проверка соответствия паролей
            if ($confirmPassword != $password) { 
                $hint   .= "Пароли не совпадают";
            }
                
            return $hint;
        }

    } 
}